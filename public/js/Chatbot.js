const { useState, useRef, useEffect } = React;

// Custom prompt untuk chatbot
const INITIAL_PROMPT = `Halo, Saya adalah Chatbot PST Menjawab, asisten digital dari Badan Pusat Statistik Provinsi DKI Jakarta. 👋📊

Tentang PST:
Pelayanan Statistik Terpadu (PST) adalah layanan satu pintu untuk seluruh pelayanan BPS di Indonesia yang dapat diakses melalui https://pst.bps.go.id yang menyediakan berbagai layanan statistik seperti penjualan publikasi, konsultasi statistik, perpustakaan tercetak dan digital, serta data mikro untuk seluruh Indonesia.

Tentang PST Menjawab:
PST Menjawab adalah layanan konsultasi statistik online yang khusus disediakan oleh PST BPS Provinsi DKI Jakarta. Layanan ini bertujuan memudahkan masyarakat DKI Jakarta dalam mengakses dan memahami data statistik serta mendapatkan bimbingan dalam analisis data untuk wilayah DKI Jakarta.

Peran Saya Sebagai Chatbot:
Saya adalah asisten digital PST Menjawab 👋📊, siap membantu Anda dengan:
✅ Menjawab pertanyaan umum tentang statistik dan metodologi
✅ Memberikan panduan awal untuk analisis data dan interpretasi
✅ Mengarahkan ke layanan konsultasi yang sesuai kebutuhan
✅ Membantu menemukan sumber data statistik yang relevan

Batasan Layanan:
- Untuk konsultasi mendalam atau analisis khusus yang membutuhkan pendampingan ahli, silakan gunakan layanan Konsultasi Online melalui menu Konsultasi
- Jika ada pertanyaan yang di luar cakupan pengetahuan saya, saya akan mengarahkan Anda ke https://silastik.bps.go.id
- Untuk layanan statistik di luar DKI Jakarta, silakan kunjungi https://pst.bps.go.id
- Saya tidak dapat memberikan interpretasi resmi atas data BPS, untuk hal tersebut silakan konsultasi langsung dengan petugas kami
- Mohon ajukan pertanyaan dengan jelas dan spesifik disertai konteks atau tujuan dari pertanyaan Anda
- Untuk data terbaru, selalu periksa https://silastik.bps.go.id dan https://bps.go.id
- Gunakan menu Konsultasi untuk diskusi mendalam dengan ahli

Bagaimana saya bisa membantu Anda hari ini? 😊`;

let TRAINING_DATA = {}; // awalnya kosong

// Ambil data training dari endpoint CodeIgniter
fetch("/api/keywords")
  .then((res) => res.json())
  .then((data) => {
    data.forEach((item) => {
      TRAINING_DATA[item.keyword.toLowerCase()] = item.link;
    });
    console.log("Training data berhasil dimuat:", TRAINING_DATA);
  })
  .catch((err) => console.error("Gagal load training data:", err));

const handleUserQuery = (query) => {
  // Convert query to lowercase for case-insensitive matching
  const lowercaseQuery = query.toLowerCase();

  // Find matching keywords
  for (const [keyword, url] of Object.entries(TRAINING_DATA)) {
    if (lowercaseQuery.includes(keyword)) {
      return `Anda dapat menemukan data tentang ${keyword} di link berikut:\n${url}`;
    }
  }

  return "Maaf, saya tidak menemukan data spesifik untuk permintaan Anda. Silakan kunjungi https://jakarta.bps.go.id untuk melihat katalog data lengkap.";
};

function formatMessage(text) {
  if (!text) return "";

  let formattedText = text;

  // Format URLs with clickable links (process this first)
  formattedText = formattedText.replace(
    /(https?:\/\/[^\s]+)/g,
    '<a href="$1" target="_blank" class="text-blue-500 hover:text-blue-700 underline">$1</a>'
  );

  // Format bold text with ** **
  formattedText = formattedText.replace(
    /\*\*((?!\*\*).+?)\*\*/g,
    "<strong>$1</strong>"
  );

  // Format tables
  if (text.includes("|")) {
    const lines = text.split("\n");
    const tableLines = [];
    let inTable = false;

    lines.forEach((line) => {
      if (line.includes("|")) {
        if (!inTable) {
          tableLines.push(
            '<div class="overflow-x-auto"><table class="min-w-full bg-white border-collapse border border-gray-300">'
          );
          inTable = true;
        }

        const cells = line.split("|").filter((cell) => cell.trim());
        if (line.includes("---")) {
          // Skip header separator line
          return;
        }

        const isHeader = tableLines.length === 1;
        tableLines.push("<tr>");
        cells.forEach((cell) => {
          if (isHeader) {
            tableLines.push(
              `<th class="border border-gray-300 px-4 py-2 bg-gray-100">${cell.trim()}</th>`
            );
          } else {
            tableLines.push(
              `<td class="border border-gray-300 px-4 py-2">${cell.trim()}</td>`
            );
          }
        });
        tableLines.push("</tr>");
      } else if (inTable) {
        tableLines.push("</table></div>");
        inTable = false;
      }
    });

    if (inTable) {
      tableLines.push("</table></div>");
    }

    formattedText = text.includes("|") ? tableLines.join("") : formattedText;
  }

  // Format lists
  formattedText = formattedText.replace(
    /^- (.*)/gm,
    '<li class="list-disc ml-4">$1</li>'
  );
  formattedText = formattedText.replace(
    /^(\d+)\. (.*)/gm,
    '<li class="list-decimal ml-4">$1. $2</li>'
  );

  // Format code blocks
  formattedText = formattedText.replace(
    /```([\s\S]*?)```/g,
    '<pre class="bg-gray-100 p-4 rounded-lg overflow-x-auto"><code>$1</code></pre>'
  );

  // Format inline code
  formattedText = formattedText.replace(
    /`([^`]+)`/g,
    '<code class="bg-gray-100 px-1 rounded">$1</code>'
  );

  // Convert newlines to <br> tags
  formattedText = formattedText.replace(/\n/g, "<br>");

  return formattedText;
}

function Chatbot() {
  const [messages, setMessages] = useState([
    {
      role: "assistant",
      content: INITIAL_PROMPT,
    },
  ]);
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);
  const [topic, setTopic] = useState("");
  const messagesEndRef = useRef(null);
  const chatContainerRef = useRef(null);

  const scrollToBottom = () => {
    if (chatContainerRef.current) {
      chatContainerRef.current.scrollTop =
        chatContainerRef.current.scrollHeight;
    }
  };

  useEffect(() => {
    scrollToBottom();
  }, [messages, loading]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!input.trim()) return;

    const userMessage = {
      role: "user",
      content: input,
    };
    setMessages((prev) => [...prev, userMessage]);
    setInput("");
    setLoading(true);

    try {
      // Cek dulu di training data
      const lowercaseInput = input.toLowerCase();
      let trainingDataResponse = null;

      for (const [keyword, url] of Object.entries(TRAINING_DATA)) {
        if (lowercaseInput.includes(keyword)) {
          trainingDataResponse = `Untuk data tentang ${keyword}, Anda dapat mengakses:\n${url}`;
          break;
        }
      }

      // Kirim ke Gemini dengan konteks training data
      const response = await fetch(
        "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-8b:generateContent",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "x-goog-api-key": "AIzaSyBwTE_iWrs3-jgHJYCvEn8bVkp0zrmWIVM",
          },
          body: JSON.stringify({
            contents: [
              {
                parts: [
                  {
                    text: `${INITIAL_PROMPT}\n\nPertanyaan pengguna: ${input}\n\n${
                      trainingDataResponse
                        ? `Saya menemukan data terkait di: ${trainingDataResponse}\n\n Analisis pertanyaan pengguna dan gunakan pengolah kata untuk mencocokkan dengan training data yang dimiliki .Berikan respons yang menjelaskan data tersebut dan bagaimana mengaksesnya.`
                        : "Berikan respons umum sesuai konteks pertanyaan."
                    }`,
                  },
                ],
              },
            ],
          }),
        }
      );

      const data = await response.json();
      const botMessage = {
        role: "assistant",
        content: data.candidates[0].content.parts[0].text,
      };

      setMessages((prev) => [...prev, botMessage]);
    } catch (error) {
      console.error("Error:", error);
      const errorMessage = {
        role: "assistant",
        content: "Maaf, terjadi kesalahan. Silakan coba lagi.",
      };
      setMessages((prev) => [...prev, errorMessage]);
    }

    setLoading(false);
  };

  const handleNewChat = () => {
    setMessages([
      {
        role: "assistant",
        content: INITIAL_PROMPT,
      },
    ]);
  };

  return (
    <div className="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
      <div className="flex justify-between mb-4">
        <button
          className="bg-gray-100 text-black py-2 px-6 rounded-full hover:bg-gray-200 transition-colors"
          onClick={() => (window.location.href = "/")}
        >
          Kembali
        </button>
        <button
          className="bg-gray-100 text-black py-2 px-6 rounded-full hover:bg-gray-200 transition-colors"
          onClick={handleNewChat}
        >
          Obrolan Baru
        </button>
      </div>

      <div className="bg-white shadow p-4 flex items-center">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          strokeWidth="2"
          strokeLinecap="round"
          strokeLinejoin="round"
          className="w-6 h-6 text-orange-500 mr-2"
        >
          <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path>
        </svg>
        <h1 className="text-lg font-semibold">PST Menjawab Chatbot</h1>
      </div>

      {/* Chat messages container */}
      <div
        ref={chatContainerRef}
        className="bg-gray-50 rounded-lg p-4 mb-6 min-h-[400px] max-h-[600px] overflow-y-auto"
      >
        <div className="space-y-4">
          {messages.map((message, index) => (
            <div
              key={index}
              className={`flex items-start gap-3 ${
                message.role === "user" ? "justify-end" : ""
              }`}
            >
              {message.role === "assistant" && (
                <div className="shrink-0 w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    className="text-orange-500"
                  >
                    <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path>
                  </svg>
                </div>
              )}
              <div
                className={`px-4 py-3 rounded-lg ${
                  message.role === "user"
                    ? "bg-orange-500 text-white rounded-br-none max-w-[80%] ml-auto"
                    : "bg-white max-w-[80%]"
                }`}
                dangerouslySetInnerHTML={{
                  __html:
                    message.role === "assistant"
                      ? formatMessage(message.content)
                      : message.content,
                }}
              />
              {message.role === "user" && (
                <div className="shrink-0 w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    className="text-gray-500"
                  >
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </div>
              )}
            </div>
          ))}
          {loading && (
            <div className="flex items-start gap-3">
              <div className="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  className="text-orange-500"
                >
                  <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path>
                </svg>
              </div>
              <div className="flex-1 px-4 py-3 rounded-lg bg-white">
                Mengetik...
              </div>
            </div>
          )}
          <div ref={messagesEndRef} />
        </div>
      </div>

      <form onSubmit={handleSubmit} className="flex gap-3">
        <div className="flex-1">
          <textarea
            value={input}
            onChange={(e) => setInput(e.target.value)}
            placeholder="Ketik pesan Anda..."
            className="w-full px-4 py-3 bg-gray-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 resize-none overflow-y-auto"
            style={{
              minHeight: "50px",
              maxHeight: "150px",
              height: "auto",
            }}
            onInput={(e) => {
              // Auto resize textarea based on content
              e.target.style.height = "auto";
              e.target.style.height =
                Math.min(e.target.scrollHeight, 150) + "px";
            }}
            onKeyDown={(e) => {
              // Submit on Enter (without Shift)
              if (e.key === "Enter" && !e.shiftKey) {
                e.preventDefault();
                handleSubmit(e);
              }
            }}
          />
        </div>
        <button
          type="submit"
          disabled={loading}
          className="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors h-[50px]"
        >
          Kirim
        </button>
      </form>
    </div>
  );
}

window.Chatbot = Chatbot;
