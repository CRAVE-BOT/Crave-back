<template>
    <div>
        <div class="chat-icon" @click="toggleChat">
            🤖
        </div>

        <transition name="fade">
            <div v-if="isChatOpen" class="chat-container">
                <div class="chat-header">
                    <h2>Crave Assistant</h2>
                    <button class="close-btn" @click="toggleChat">✖</button>
                </div>

                <div class="chat-box">
                    <div v-for="(msg, index) in responses" :key="index" :class="['message', msg.sender]">
                        <span v-if="msg.sender === 'user'" class="user-icon">👤</span>
                        <span v-if="msg.sender === 'bot'" class="bot-icon">🤖</span>
                        <div class="message-content">{{ msg.text }}</div>
                    </div>
                </div>

                <div class="question-buttons">
                    <button v-for="(question, index) in questions" :key="index" @click="sendMessage(question)">
                        {{ question }}
                    </button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            isChatOpen: false,
            responses: [],
            questions: [],
        };
    },
    methods: {
        toggleChat() {
            this.isChatOpen = !this.isChatOpen;

            // ✅ إضافة رسالة ترحيب عند فتح الشات لأول مرة
            if (this.isChatOpen && this.responses.length === 0) {
                this.responses.push({
                    text: "👋 Hello! I’m Crave Assistant How can  " +
                        " I assist you today?",
                    sender: "bot"
                });
            }
        },
        async sendMessage(question) {
            this.responses.push({ text: question, sender: "user" });

            try {
                const res = await axios.post("/api/chatbot", { message: question });
                this.responses.push({ text: res.data.response, sender: "bot" });
            } catch (error) {
                console.error("Error sending message", error);
            }
        },
        async fetchQuestions() {
            try {
                const res = await axios.get("/api/chatbot/questions");
                this.questions = res.data;
            } catch (error) {
                console.error("Error fetching questions", error);
            }
        }
    },
    mounted() {
        this.fetchQuestions();
    }
};
</script>


<style>
/* ✅ تأثير الفتح والإغلاق */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease-in-out;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}

/* ✅ أيقونة الشات بوت */
.chat-icon {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: linear-gradient(135deg, #ffb700, #ff5900);
    color: white;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(255, 87, 34, 0.3);
    transition: transform 0.3s, box-shadow 0.3s;
}
.chat-icon:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(255, 87, 34, 0.5);
}

/* ✅ صندوق الشات - تم تكبير الحجم */
.chat-container {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 420px;
    background: rgba(0, 0, 0, 0.85);
    border-radius: 15px;
    box-shadow: 0px 6px 20px rgba(255, 87, 34, 0.4);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    font-family: 'Poppins', sans-serif;
    backdrop-filter: blur(14px);
    z-index: 1000;
}

/* ✅ الهيدر */
.chat-header {
    background: linear-gradient(135deg, #ffb700, #ff5900);
    color: white;
    text-align: center;
    padding: 16px;
    font-size: 20px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

/* ✅ صندوق الرسائل */
.chat-box {
    height: 350px;
    overflow-y: auto;
    padding: 15px;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    flex-direction: column;
    gap: 12px;
}

/* ✅ الرسائل */
.message {
    display: flex;
    align-items: center;
    max-width: 90%;
    padding: 14px;
    border-radius: 15px;
    font-size: 16px;
    word-wrap: break-word;
}

.user {
    align-self: flex-end;
    background: #ffb700;
    color: white;
    text-align: right;
    border-top-right-radius: 0;
    border-bottom-right-radius: 15px;
    border-bottom-left-radius: 15px;
}

.bot {
    align-self: flex-start;
    background: #2c2c2c;
    color: white;
    text-align: left;
    border-top-left-radius: 0;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}

/* ✅ تحسين أزرار الأسئلة - Grid Layout */
.question-buttons {
    padding: 16px;
    background: rgba(255, 255, 255, 0.15);
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    justify-content: center;
}
.question-buttons button {
    padding: 12px 18px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #ff5900, #ffb700);
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    font-size: 15px;
}
.question-buttons button:hover {
    background: linear-gradient(135deg, #ff3a00, #ff9800);
    transform: scale(1.05);
    box-shadow: 0 6px 15px rgba(255, 87, 34, 0.4);
}
</style>
