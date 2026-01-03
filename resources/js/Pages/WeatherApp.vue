<script setup>
import { Head } from '@inertiajs/vue3';
import WeatherSidebar from '@/Components/WeatherSidebar.vue';
import WeatherDisplay from '@/Components/WeatherDisplay.vue';
import { computed } from 'vue';

const props = defineProps({
    weatherData: Object,
    favorites: Array,
    errors: Object,
    flash: Object,
    isFavorite: Boolean
});

// LOGIQUE D'AMBIANCE : Change le fond selon la météo
const bgClass = computed(() => {
    if (!props.weatherData) return 'from-slate-900 via-slate-800 to-slate-900'; // Défaut

    const weatherId = props.weatherData.weather[0].id;
    const isNight = props.weatherData.weather[0].icon.includes('n');

    // NUIT (Priorité)
    if (isNight) return 'from-indigo-950 via-purple-900 to-slate-900';

    // ORAGE (2xx)
    if (weatherId >= 200 && weatherId < 300) return 'from-slate-800 via-purple-900 to-slate-900';
    // PLUIE (3xx, 5xx)
    if (weatherId >= 300 && weatherId < 600) return 'from-slate-700 via-blue-900 to-slate-800';
    // NEIGE (6xx)
    if (weatherId >= 600 && weatherId < 700) return 'from-blue-100 via-white to-blue-200 text-slate-800'; // Exception claire
    // ATMOSPHERE (7xx - Brouillard)
    if (weatherId >= 700 && weatherId < 800) return 'from-slate-500 via-gray-400 to-slate-600';
    // CLAIR (800)
    if (weatherId === 800) return 'from-blue-400 via-blue-300 to-orange-200'; // Beau ciel bleu
    // NUAGES (80x)
    return 'from-blue-300 via-slate-300 to-gray-200';
});
</script>

<template>
    <Head title="Météo Harmonie" />

    <div
        class="min-h-screen bg-gradient-to-br transition-colors duration-1000 ease-in-out flex flex-col md:flex-row overflow-hidden font-sans text-white"
        :class="bgClass"
    >

        <WeatherSidebar
            :favorites="favorites"
            :errors="errors"
            :flash="$page.props.flash"
        />

        <WeatherDisplay
            :weatherData="weatherData"
            :isFavorite="isFavorite"
        />

    </div>
</template>
