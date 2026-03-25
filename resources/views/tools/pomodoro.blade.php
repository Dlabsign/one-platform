<x-layout title="Pomodoro Timer - PDF Planet">
    <x-navbar />

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-10 pb-20">
        <div class="max-w-4xl mx-auto px-4">
            
            {{-- Header --}}
            <div class="text-center mb-4">
                <h1 class="text-[clamp(2rem,4vw,3rem)] font-['Syne',sans-serif] font-extrabold text-white mb-2">Pomodoro Timer</h1>
                <p class="text-slate-400 font-light">Fokus pada pekerjaan Anda, istirahat sejenak, dan selesaikan tugas.</p>
            </div>

            {{-- Timer Container --}}
<div id="pomodoroContainer" class="w-full bg-red-500/10 px-4 py-8 md:p-12 rounded-[24px] border border-white/10 mb-8 transition-colors duration-500 text-center overflow-hidden flex flex-col items-center justify-center">
    
    {{-- Ubah space-x menjadi gap & flex-wrap agar tombol rapi di layar kecil --}}
    <div class="flex justify-center flex-wrap gap-2 md:gap-4 mb-8 w-full">
        <button id="mode-pomodoro" class="mode-btn active bg-red-500 text-white px-4 py-2 rounded-lg font-bold shadow-sm transition">Pomodoro</button>
        <button id="mode-short" class="mode-btn text-slate-400 hover:bg-white/5 px-4 py-2 rounded-lg font-semibold transition">Short Break</button>
        <button id="mode-long" class="mode-btn text-slate-400 hover:bg-white/5 px-4 py-2 rounded-lg font-semibold transition">Long Break</button>
    </div>

    {{-- Gunakan clamp() untuk font size agar fluid dan responsif --}}
    <div class="w-full font-['Syne',sans-serif] text-[clamp(5rem,18vw,12rem)] font-black text-white mb-8 leading-none tabular-nums tracking-tight flex justify-center items-center" id="timerDisplay">
        25:00
    </div>

    {{-- Tambahkan flex-wrap di sini juga untuk jaga-jaga --}}
    <div class="flex justify-center items-center gap-4 flex-wrap w-full">
        <button id="startBtn" class="bg-gray-800 text-red-400 hover:text-red-300 border-b-4 border-red-500/30 hover:border-red-500/50 hover:bg-gray-700 px-12 py-4 rounded-xl text-2xl font-black uppercase tracking-widest transition transform active:translate-y-1 active:border-b-0">
            Start
        </button>
        <button id="resetBtn" class="bg-white/5 hover:bg-white/10 text-slate-300 p-4 rounded-xl font-bold transition transform active:translate-y-1 shrink-0" title="Reset Timer">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
        </button>
    </div>
</div>

            {{-- Task Container --}}
            <div class="max-w-2xl mx-auto bg-gray-900 p-6 md:p-8 rounded-[24px] border border-white/10 shadow-xl">
                <h2 class="font-['Syne',sans-serif] text-2xl font-bold text-white mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Daftar Tugas
                </h2>

                <form id="taskForm" class="flex mb-6">
                    <input type="text" id="taskInput" placeholder="Apa yang sedang Anda kerjakan?" class="flex-1 bg-gray-800 border border-white/10 rounded-l-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" required>
                    <button type="submit" class="bg-teal-500 hover:bg-teal-400 text-gray-900 px-6 py-3 rounded-r-lg font-bold transition">
                        Tambah
                    </button>
                </form>

                <ul id="taskList" class="space-y-3">
                </ul>

                <div id="emptyTask" class="text-center text-slate-500 py-6 hidden">
                    Belum ada tugas. Tambahkan tugas baru di atas!
                </div>
            </div>

        </div>
    </div>

    <audio id="alarmSound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

    {{-- Import Font (Opsional jika belum ada di layout utama) --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap');
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /* ==========================================
               LOGIKA POMODORO TIMER (Logika tetap, Class CSS diubah)
               ========================================== */
            const timerDisplay = document.getElementById('timerDisplay');
            const startBtn = document.getElementById('startBtn');
            const resetBtn = document.getElementById('resetBtn');
            const pomodoroContainer = document.getElementById('pomodoroContainer');
            const alarmSound = document.getElementById('alarmSound');
            
            const modes = {
                pomodoro: { time: 1 * 2, color: 'bg-red-500/10', btnColor: 'bg-red-500', textColor: 'text-red-400', btnBorder: 'border-red-500/30', btnHoverBorder: 'hover:border-red-500/50', hoverText: 'hover:text-red-300' },
                short: { time: 5 * 60, color: 'bg-teal-500/10', btnColor: 'bg-teal-500', textColor: 'text-teal-400', btnBorder: 'border-teal-500/30', btnHoverBorder: 'hover:border-teal-500/50', hoverText: 'hover:text-teal-300' },
                long: { time: 15 * 60, color: 'bg-blue-500/10', btnColor: 'bg-blue-500', textColor: 'text-blue-400', btnBorder: 'border-blue-500/30', btnHoverBorder: 'hover:border-blue-500/50', hoverText: 'hover:text-blue-300' }
            };

            let currentMode = 'pomodoro';
            let timer = null;
            let timeLeft = modes[currentMode].time;
            let isRunning = false;

            // Fungsi Format Waktu (MM:SS)
            function updateDisplay() {
                const minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
                const seconds = (timeLeft % 60).toString().padStart(2, '0');
                const timeString = `${minutes}:${seconds}`;
                timerDisplay.textContent = timeString;
                
                document.title = `${timeString} - ${currentMode === 'pomodoro' ? 'Fokus!' : 'Istirahat'}`;
            }

            function setMode(mode) {
                currentMode = mode;
                timeLeft = modes[mode].time;
                isRunning = false;
                clearInterval(timer);
                startBtn.textContent = 'Start';
                
                // Ubah UI
                document.querySelectorAll('.mode-btn').forEach(btn => {
                    btn.className = 'mode-btn text-slate-400 hover:bg-white/5 px-4 py-2 rounded-lg font-semibold transition';
                });
                const activeBtn = document.getElementById(`mode-${mode}`);
                activeBtn.className = `mode-btn active ${modes[mode].btnColor} text-white px-4 py-2 rounded-lg font-bold shadow-sm transition`;

                // Ubah Warna Background Container & Tombol Start
                pomodoroContainer.className = `${modes[mode].color} p-8 md:p-12 rounded-[24px] border border-white/10 mb-8 transition-colors duration-500 text-center`;
                startBtn.className = `bg-gray-800 hover:bg-gray-700 ${modes[mode].textColor} ${modes[mode].hoverText} border-b-4 ${modes[mode].btnBorder} ${modes[mode].btnHoverBorder} px-12 py-4 rounded-xl text-2xl font-black uppercase tracking-widest transition transform active:translate-y-1 active:border-b-0`;

                updateDisplay();
            }

            // Event Listener Tombol Mode
            document.getElementById('mode-pomodoro').addEventListener('click', () => setMode('pomodoro'));
            document.getElementById('mode-short').addEventListener('click', () => setMode('short'));
            document.getElementById('mode-long').addEventListener('click', () => setMode('long'));

            // Logika Play / Pause Timer
            startBtn.addEventListener('click', function() {
                if (isRunning) {
                    clearInterval(timer);
                    startBtn.textContent = 'Start';
                } else {
                    startBtn.textContent = 'Pause';
                    timer = setInterval(() => {
                        timeLeft--;
                        updateDisplay();

                        if (timeLeft <= 0) {
                            clearInterval(timer);
                            isRunning = false;
                            startBtn.textContent = 'Start';
                            alarmSound.play(); // Putar suara alarm
                            alert('Waktu habis! Kerja bagus.');
                            setMode(currentMode); // Reset ke waktu awal mode tersebut
                        }
                    }, 1000);
                }
                isRunning = !isRunning;
            });

            // Logika Reset Timer
            resetBtn.addEventListener('click', function() {
                setMode(currentMode);
            });

            // Inisialisasi awal
            updateDisplay();


            /* ==========================================
               LOGIKA TO-DO LIST (LOCAL STORAGE)
               ========================================== */
            const taskForm = document.getElementById('taskForm');
            const taskInput = document.getElementById('taskInput');
            const taskList = document.getElementById('taskList');
            const emptyTask = document.getElementById('emptyTask');

            // Ambil data dari Local Storage atau buat array kosong
            let tasks = JSON.parse(localStorage.getItem('pomodoro_tasks')) || [];

            function saveTasks() {
                localStorage.setItem('pomodoro_tasks', JSON.stringify(tasks));
                renderTasks();
            }

            function renderTasks() {
                taskList.innerHTML = '';
                
                if (tasks.length === 0) {
                    emptyTask.classList.remove('hidden');
                } else {
                    emptyTask.classList.add('hidden');
                    
                    tasks.forEach((task, index) => {
                        const li = document.createElement('li');
                        // Ubah class CSS untuk dark mode di sini
                        li.className = `flex items-center justify-between p-4 rounded-xl border ${task.completed ? 'bg-gray-800/50 border-white/5' : 'bg-gray-800 border-white/10 shadow-sm'} transition`;
                        
                        li.innerHTML = `
                            <div class="flex items-center space-x-3 flex-1 overflow-hidden">
                                <input type="checkbox" ${task.completed ? 'checked' : ''} onchange="toggleTask(${index})" class="w-5 h-5 text-teal-500 bg-gray-900 border-white/20 rounded focus:ring-teal-500 focus:ring-offset-gray-900 cursor-pointer">
                                <span class="font-medium truncate ${task.completed ? 'line-through text-slate-500' : 'text-slate-200'}">${task.text}</span>
                            </div>
                            <button onclick="deleteTask(${index})" class="text-slate-500 hover:text-red-400 ml-4 p-2 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        `;
                        taskList.appendChild(li);
                    });
                }
            }

            // Event Submit Form Tambah Tugas
            taskForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const text = taskInput.value.trim();
                if (text) {
                    tasks.push({ text: text, completed: false });
                    taskInput.value = '';
                    saveTasks();
                }
            });

            // Jadikan fungsi global agar bisa dipanggil dari atribut onclick di HTML
            window.toggleTask = function(index) {
                tasks[index].completed = !tasks[index].completed;
                saveTasks();
            };

            window.deleteTask = function(index) {
                if(confirm('Hapus tugas ini?')) {
                    tasks.splice(index, 1);
                    saveTasks();
                }
            };

            // Render pertama kali
            renderTasks();
        });
    </script>
</x-layout>