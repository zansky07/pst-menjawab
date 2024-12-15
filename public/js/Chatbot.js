const { useState } = React;

function Chatbot() {
  const [messages, setMessages] = useState([]);
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);
  const [topic, setTopic] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!input.trim()) return;

    if (!topic && messages.length === 0) {
      setTopic(input);
    }

    const userMessage = {
      role: "user",
      content: input,
    };
    setMessages((prev) => [...prev, userMessage]);
    setInput("");
    setLoading(true);

    try {
      const response = await fetch(
        "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent",
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
                    text: input,
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
    setMessages([]);
    setTopic("");
  };

  return (
    <div className="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
      {/* Navigation Buttons */}
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

      {/* Topic Display */}
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

      {/* Chat Container */}
      <div className="bg-gray-50 rounded-lg p-4 mb-6 min-h-[400px] max-h-[600px] overflow-y-auto">
        <div className="space-y-4">
          {messages.map((message, index) => (
            <div
              key={index}
              className={`flex items-start gap-3 ${
                message.role === "user" ? "flex-row-reverse" : ""
              }`}
            >
              <div
                className={`shrink-0 w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center`}
              >
                {message.role === "assistant" ? (
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
                ) : (
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
                )}
              </div>
              <div
                className={`flex-1 px-4 py-3 rounded-lg ${
                  message.role === "user"
                    ? "bg-orange-500 text-white"
                    : "bg-white"
                }`}
              >
                {message.content}
              </div>
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
        </div>
      </div>

      {/* Input Form */}
      <form onSubmit={handleSubmit} className="flex gap-3">
        <input
          type="text"
          value={input}
          onChange={(e) => setInput(e.target.value)}
          placeholder="Ketik pesan Anda..."
          className="flex-1 px-4 py-3 bg-gray-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
        />
        <button
          type="submit"
          disabled={loading}
          className="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors"
        >
          Kirim
        </button>
      </form>
    </div>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<Chatbot />);
