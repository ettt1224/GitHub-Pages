<!DOCTYPE html>
<html lang="zh-TW" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name }} | 2025 雙欄儀表板履歷</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #020617; color: #f8fafc; overflow: hidden; font-family: 'Space Grotesk', sans-serif; }
        .glow-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
            background: radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.08) 0%, transparent 50%);
        }
        .glass { 
            background: rgba(15, 23, 42, 0.5); 
            backdrop-filter: blur(16px); 
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .project-item:hover { background: rgba(59, 130, 246, 0.05); border-color: rgba(59, 130, 246, 0.2); }
    </style>
</head>
<body class="antialiased h-screen flex flex-col p-6 md:p-10">

    <div class="glow-bg"></div>

    <!-- Main Container: 100% Height, 50/50 Split -->
    <div class="flex-1 flex flex-col md:flex-row gap-8 max-w-7xl mx-auto w-full overflow-hidden">
        
        <!-- 左側欄位 (50%) -->
        <div class="flex-1 flex flex-col gap-6 overflow-hidden">
            <!-- 姓名與標題 -->
            <header class="flex-none">
                <h1 class="text-5xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500 mb-2">
                    {{ $name }}
                </h1>
                <p class="text-lg text-slate-400 font-medium uppercase tracking-[0.2em]">{{ $title }}</p>
            </header>

            <!-- 關於我 -->
            <section class="flex-none glass p-8 rounded-[2rem] relative overflow-hidden">
                <div class="absolute top-4 right-4 text-blue-500/10 text-4xl">👤</div>
                <h2 class="text-[10px] font-black uppercase tracking-widest text-blue-500 mb-4 border-b border-blue-500/20 pb-2 inline-block">關於我 / About Me</h2>
                <p class="text-xl font-light leading-relaxed text-slate-200">
                    {{ $bio }}
                </p>
            </section>

            <!-- 技術棧 (由上至下排序) -->
            <section class="flex-1 glass p-8 rounded-[2rem] flex flex-col justify-between overflow-hidden">
                <h2 class="text-[10px] font-black uppercase tracking-widest text-green-500 mb-4 border-b border-green-500/20 pb-2 inline-block">掌握技術 / Tech Stack</h2>
                <div class="flex-1 flex flex-col justify-around gap-2">
                    @foreach($skills_groups as $group)
                    <div class="flex items-center gap-6 group">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-500 group-hover:scale-150 transition"></div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $group['category'] }}</p>
                            <p class="text-xl font-black text-white group-hover:text-blue-400 transition">{{ $group['items'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- 右側欄位 (50%) -->
        <div class="flex-1 flex flex-col gap-6 overflow-hidden">
            <!-- 聯絡方式 -->
            <section class="flex-none glass p-8 rounded-[2rem] bg-gradient-to-br from-purple-500/5 to-transparent relative overflow-hidden">
                <div class="absolute top-4 right-4 text-purple-500/10 text-4xl">📧</div>
                <h2 class="text-[10px] font-black uppercase tracking-widest text-purple-500 mb-6 border-b border-purple-500/20 pb-2 inline-block">聯絡方式 / Contact</h2>
                
                <div class="grid grid-cols-1 gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl glass flex items-center justify-center text-xl">✉️</div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-500 uppercase">電子郵件</p>
                            <p class="text-lg font-bold">{{ $contact['email'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl glass flex items-center justify-center text-xl">🐙</div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-500 uppercase">GitHub</p>
                            <p class="text-lg font-bold">github.com/ettt1224</p>
                        </div>
                    </div>
                    <a href="mailto:{{ $contact['email'] }}" class="mt-2 py-3 bg-white text-dark text-center font-black rounded-xl hover:bg-blue-400 transition text-sm">
                        立即與我聯繫
                    </a>
                </div>
            </section>

            <!-- 精選專案 (垂直排列) -->
            <section class="flex-1 glass p-8 rounded-[2rem] flex flex-col overflow-hidden">
                <div class="flex justify-between items-center mb-6 border-b border-purple-500/20 pb-2">
                    <h2 class="text-[10px] font-black uppercase tracking-widest text-purple-500">精選專案 / Projects</h2>
                    <a href="{{ $contact['github'] }}" class="text-[10px] font-bold text-blue-400 hover:text-white transition uppercase">View All ↗</a>
                </div>
                
                <div class="flex-1 flex flex-col gap-4 overflow-hidden">
                    @foreach($projects as $project)
                    <div class="flex-1 glass p-5 rounded-2xl border border-white/5 hover:border-blue-500/30 transition flex flex-col justify-center group relative overflow-hidden project-item">
                        <div class="absolute -right-2 -top-2 text-5xl opacity-[0.02] group-hover:opacity-[0.1] transition-opacity">📂</div>
                        <h3 class="text-lg font-bold group-hover:text-blue-400 transition">{{ $project['name'] }}</h3>
                        <p class="text-slate-400 text-xs line-clamp-2 leading-relaxed">{{ $project['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

    </div>

    <!-- Footer -->
    <footer class="flex-none flex justify-between items-center text-slate-600 text-[9px] uppercase tracking-[0.3em] pt-6">
        <p>© 2025 {{ $name }} | 版權所有</p>
        <p>Built with Laravel Zero & Tailwind CSS</p>
    </footer>

</body>
</html>
