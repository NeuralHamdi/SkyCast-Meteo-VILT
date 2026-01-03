<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyCast - Météo VILT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0B1120] text-white h-screen flex flex-col items-center justify-center relative overflow-hidden selection:bg-indigo-500 selection:text-white">

<div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-indigo-600/20 blur-[120px] rounded-full pointer-events-none"></div>

<main class="relative z-10 text-center px-6 max-w-4xl mx-auto">

    <div class="inline-flex items-center gap-2 px-3 py-1 mb-8 rounded-full border border-indigo-500/30 bg-indigo-500/10 text-indigo-300 text-xs font-semibold uppercase tracking-wider">
        <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
        Architecture VILT
    </div>

    <h1 class="text-5xl md:text-7xl font-bold tracking-tight mb-6 text-transparent bg-clip-text bg-gradient-to-b from-white to-white/60">
        SkyCast App
    </h1>

    <p class="text-lg md:text-xl text-slate-400 mb-10 max-w-2xl mx-auto leading-relaxed">
        Une application météo moderne développée avec <span class="text-indigo-400 font-medium">Laravel</span> et <span class="text-green-400 font-medium">Vue.js</span>.
        <br>Rapide, fluide et sans rechargement de page.
    </p>

    <a href="/meteo" class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-[#0B1120] rounded-full font-bold text-lg transition-all hover:scale-105 hover:shadow-[0_0_40px_-10px_rgba(255,255,255,0.3)]">
        Lancer l'Application
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>
    </a>

    <div class="mt-20 pt-10 border-t border-white/5">
        <p class="text-sm text-slate-600 uppercase tracking-widest mb-6 font-semibold">Technologies utilisées</p>
        <div class="flex justify-center gap-8 grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition duration-500">
            <div class="flex flex-col items-center gap-2">
                <svg class="h-8 w-8 text-red-500" viewBox="0 0 24 24" fill="currentColor"><path d="M5 5.5C5 4 7 3 9.5 3C12 3 14 4 14 5.5C14 7 12 8 9.5 8C7 8 5 7 5 5.5Z" stroke="currentColor" stroke-width="0"/><path d="M5 5.5V18.5C5 20 7 21 9.5 21C12 21 14 20 14 18.5V5.5" stroke="currentColor" stroke-width="0"/><path d="M14 18.5H19" stroke="currentColor" stroke-width="2"/></svg>
                <span class="text-xs font-medium">Laravel</span>
            </div>
            <div class="flex flex-col items-center gap-2">
                <svg class="h-8 w-8 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 22h20L12 2z"/></svg>
                <span class="text-xs font-medium">Vue.js</span>
            </div>
            <div class="flex flex-col items-center gap-2">
                <svg class="h-8 w-8 text-cyan-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 12s3-7 10-2c7 5 10-7 10-7"/></svg>
                <span class="text-xs font-medium">Tailwind</span>
            </div>
        </div>
    </div>

</main>

<footer class="absolute bottom-6 text-center text-slate-600 text-xs">
    &copy; 2024 SkyCast Project.
</footer>

</body>
</html>
