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

const TRAINING_DATA = {
  // Sosial & Kependudukan
  dprd: "https://jakarta.bps.go.id/statictable/2021/08/16/249/-jumlah-keputusan-dprd-menurut-jenisnya-2019---2020.html",
  "anggota dprd":
    "https://jakarta.bps.go.id/statictable/2021/08/16/247/jumlah-anggota-dewan-perwakilan-rakyat-daerah-menurut-kabupaten-kota-dan-jenis-kelamin-2020.html",
  "partai politik dprd":
    "https://jakarta.bps.go.id/statictable/2023/03/13/633/jumlah-anggota-dewan-perwakilan-rakyat-daerah-menurut-partai-politik-dan-jenis-kelamin-2022.html",
  "sekolah dasar":
    "https://jakarta.bps.go.id/statictable/2015/04/21/86/banyaknya-sekolah-dasar-negeri-menurut-wilayah-di-provinsi-dki-jakarta-2009-2013-dan-2020.html",
  "lampu hemat energi":
    "https://jakarta.bps.go.id/statictable/2022/08/19/605/persentase-rumah-tangga-yang-menggunakan-lampu-hemat-energi-menurut-provinsi-dan-daerah-tempat-tinggal-2014.html",
  "kerawanan sosial":
    "https://jakarta.bps.go.id/statictable/2022/07/20/502/indeks-kerawanan-sosial-menurut-kabupaten-kota-di-dki-jakarta-tahun-2019-2020.html",
  "bencana alam":
    "https://jakarta.bps.go.id/statictable/2021/09/04/280/jumlah-desa1-kelurahan-yang-mengalami-bencana-alam2-menurut-kabupaten-kota-di-provinsi-dki-jakarta-2014-2018-dan-2020.html",
  narapidana:
    "https://jakarta.bps.go.id/statictable/2021/08/20/260/-jumlah-narapidana-di-lembaga-pemasyarakatan-di-dki-jakarta-menurut-status-narapidana-dan-bulan-2020.html",

  // Transportasi
  "bus transjakarta":
    "https://jakarta.bps.go.id/indicator/17/1322/1/jumlah-bus-transjakarta-yang-beroperasi-menurut-bulan.html",
  "penumpang transjakarta":
    "https://jakarta.bps.go.id/indicator/17/1324/1/jumlah-penumpang-bus-transjakarta-menurut-bulan.html",
  lrt: "https://jakarta.bps.go.id/indicator/17/1319/1/jumlah-perjalanan-light-rail-transit-lrt-jakarta.html",
  mrt: "https://jakarta.bps.go.id/indicator/17/1318/1/jumlah-penumpang-mass-rapid-transit-mrt-jakarta.html",
  "kereta api":
    "https://jakarta.bps.go.id/indicator/17/1329/1/jumlah-penumpang-kereta-api-menurut-bulan-orang-.html",

  // PDRB
  pdrb: "https://jakarta.bps.go.id/indicator/156/65/1/pdrb-provinsi-dki-jakarta-atas-dasar-harga-konstan-menurut-pengeluaran.html",
  "distribusi pdrb":
    "https://jakarta.bps.go.id/indicator/156/67/1/distribusi-pdrb-provinsi-dki-jakarta-atas-dasar-harga-berlaku-menurut-pengeluaran.html",
  "laju pdrb":
    "https://jakarta.bps.go.id/indicator/156/66/1/laju-pertumbuhan-pdrb-menurut-pengeluaran-seri-2010-.html",

  // Pertanian
  "nilai tukar petani":
    "https://jakarta.bps.go.id/indicator/10/1268/1/nilai-tukar-petani-provinsi-dki-jakarta-2012-100-.html",
  hortikultura:
    "https://jakarta.bps.go.id/indicator/55/661/1/produksi-tanaman-sayuran-menurut-kabupaten-kota-dan-jenis-tanaman-kuintal-di-provinsi-dki-jakarta.html",
  "tanaman hias":
    "https://jakarta.bps.go.id/indicator/55/673/1/produksi-tanaman-hias-menurut-kabupaten-kota-dan-jenis-tanaman-di-provinsi-dki-jakarta-tangkai-.html",
  padi: "https://jakarta.bps.go.id/indicator/53/655/1/produksi-padi-dan-beras-menurut-kabupaten-kota-ha-di-provinsi-dki-jakarta-.html",

  // Peternakan & Perikanan
  peternakan:
    "https://jakarta.bps.go.id/indicator/24/688/1/populasi-ternak-menurut-kabupaten-kota-dan-jenis-ternak-ekor-di-provinsi-dki-jakarta.html",
  unggas:
    "https://jakarta.bps.go.id/indicator/24/691/1/populasi-unggas-menurut-kabupaten-kota-dan-jenis-unggas-di-provinsi-dki-jakarta-ekor-.html",
  perikanan:
    "https://jakarta.bps.go.id/indicator/56/695/1/produksi-dan-nilai-produksi-perikanan-tangkap-menurut-kabupaten-kota-dan-jenis-penangkapan-di-provinsi-dki-jakarta.html",

  // Usaha Mikro Kecil
  umk: "https://jakarta.bps.go.id/statictable/2022/09/12/612/jumlah-dan-persentase-umk-provinsi-dki-jakarta-menurut-kabupaten-kota-2016.html",
  "industri mikro":
    "https://jakarta.bps.go.id/indicator/35/981/1/banyaknya-usaha-perusahaan-industri-pengolahan-mikro-dan-kecil-menurut-kode-klasifikasi-baku-lapangan-usaha-indonesia-dan-kelompok-pekerja.html",

  // Ekspor-Impor
  "ekspor migas":
    "https://jakarta.bps.go.id/indicator/8/1249/1/bobot-ekspor-migas-dki-jakarta-per-bulan.html",
  "ekspor negara tujuan":
    "https://jakarta.bps.go.id/statictable/2017/02/22/160/nilai-ekspor-produk-dki-jakarta-menurut-negara-tujuan-fob-us-2013-2015.html",
  "perkembangan ekspor":
    "https://jakarta.bps.go.id/statictable/2017/01/30/101/perkembangan-nilai-ekspor-impor-melalui-dki-jakarta-dan-ekspor-produk-dki-jakarta-2008-2015.html",
  "volume ekspor":
    "https://jakarta.bps.go.id/statictable/2017/01/30/105/volume-dan-nilai-ekspor-melalui-dki-jakarta-menurut-negara-tujuan-2014-2015-.html",

  // Energi
  "produksi gas":
    "https://jakarta.bps.go.id/statictable/2015/03/30/6/jumlah-produksi-bruto-dan-penjualan-gas-2009-2013.html",

  // Kehutanan
  "kayu olahan":
    "https://jakarta.bps.go.id/indicator/60/781/1/produksi-kayu-olahan-menurut-jenis-produksi-m-.html",
  "kawasan hutan":
    "https://jakarta.bps.go.id/indicator/60/682/1/luas-kawasan-hutan-dan-perairan-menurut-kabupaten-kota-ha-.html",

  // Transportasi Tambahan
  "kendaraan bermotor":
    "https://jakarta.bps.go.id/indicator/17/786/1/jumlah-kendaraan-bermotor-menurut-jenis-kendaraan-unit-di-provinsi-dki-jakarta.html",
  "pesawat halim":
    "https://jakarta.bps.go.id/indicator/17/308/1/jumlah-penumpang-pesawat-udara-yang-berangkat-dan-datang-melalui-pelabuhan-udara-halim-perdana-kusuma.html",
  "kapal tanjung priok":
    "https://jakarta.bps.go.id/indicator/17/316/1/jumlah-penumpang-kapal-laut-antar-pulau-yang-datang-dan-berangkat-melalui-pelabuhan-laut-tanjung-priok.html",

  // UMK Tambahan
  "balas jasa umk":
    "https://jakarta.bps.go.id/statictable/2022/09/12/610/balas-jasa-dan-upah-pekerja-umk-nonpertanian-menurut-kategori-ribu-rupiah-2017.html",
  "tenaga kerja umk":
    "https://jakarta.bps.go.id/statictable/2022/09/12/613/jumlah-usaha-tenaga-kerja-dan-rata-rata-penyerapan-tenaga-kerja-umk-nonpertanian-menurut-kategori-2016.html",

  // Perikanan Tambahan
  "pengolahan ikan":
    "https://jakarta.bps.go.id/indicator/56/723/1/penyerapan-bahan-baku-produksi-olahan-dan-penggunaan-garam-di-pengolahan-hasil-perikanan-tradisional-phpt-muara-angke.html",
  "ekspor perikanan":
    "https://jakarta.bps.go.id/indicator/56/711/1/volume-ekspor-hasil-perikanan-yang-melalui-laboratorium-pengujian-mutu-hasil-perikanan-lpmhp-menurut-bulan-dan-jenis-ikan-di-provinsi-dki-jakarta.html",

  // Peternakan Tambahan
  "telur unggas":
    "https://jakarta.bps.go.id/statictable/2021/09/20/302/produksi-telur-unggas-dan-susu-sapi-menurut-kota-administrasi-ton-di-provinsi-dki-jakarta-2019.html",

  // Tanaman Pangan Tambahan
  "luas panen padi":
    "https://jakarta.bps.go.id/indicator/53/653/1/luas-panen-produksi-dan-produktivitas-padi1-menurut-kabupaten-kota-di-provinsi-dki-jakarta-ha-.html",
  "produksi pangan":
    "https://jakarta.bps.go.id/statictable/2015/04/10/39/produksi-tanaman-bahan-makanan-2009-2013.html",
};

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
                        ? `Saya menemukan data terkait di: ${trainingDataResponse}\n\nBerikan respons yang menjelaskan data tersebut dan bagaimana mengaksesnya.`
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
