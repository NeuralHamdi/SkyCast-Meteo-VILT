<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    weatherData: Object,
    isFavorite: Boolean
});

const saveForm = useForm({ city_name: '' });

const toggleFavorite = () => {
    if (props.weatherData) {
        saveForm.city_name = props.weatherData.name;
        saveForm.post(route('meteo.toggle'), { preserveScroll: true });
    }
};

// --- LOGIQUE HUMAINE ---
const greeting = computed(() => {
    const hour = new Date().getHours();
    if (hour < 12) return 'Bonjour,';
    if (hour < 18) return 'Bon après-midi,';
    return 'Bonsoir,';
});

// Conseiller personnel selon la météo
const humanAdvice = computed(() => {
    if (!props.weatherData) return '';
    const temp = props.weatherData.main.temp;
    const condition = props.weatherData.weather[0].main;

    if (condition === 'Rain' || condition === 'Drizzle') return "N'oubliez pas votre parapluie, ça mouille ! ☔";
    if (condition === 'Thunderstorm') return "Restez à l'abri, l'orage gronde. ⚡";
    if (condition === 'Snow') return "Sortez les gants et profitez de la neige ! ❄️";
    if (condition === 'Clear' && temp > 25) return "Pensez à l'eau et à la crème solaire. 😎";
    if (condition === 'Clear') return "Un ciel magnifique aujourd'hui. Profitez-en !";
    if (temp < 10) return "Brrr, couvrez-vous bien, il fait frais. 🧣";
    return "Une journée calme en perspective.";
});

const currentDate = computed(() => {
    return new Date().toLocaleDateString('fr-FR', { weekday: 'long', day: 'numeric', month: 'long' });
});
</script>

<template>
    <div class="flex-1 relative p-8 md:p-16 flex flex-col justify-center items-center overflow-hidden z-10">

        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div v-if="weatherData" class="max-w-5xl w-full z-10 animate-fade-in">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
                <div>
                    <h2 class="text-7xl md:text-9xl font-thin tracking-tighter text-white drop-shadow-2xl">
                        {{ weatherData.name }}
                    </h2>
                    <p class="text-2xl text-white/80 mt-4 font-light flex items-center gap-3">
                        <span class="uppercase tracking-widest text-sm bg-white/20 px-3 py-1 rounded-full backdrop-blur-md">{{ weatherData.sys.country }}</span>
                        {{ currentDate }}
                    </p>
                </div>

                <button
                    @click="toggleFavorite"
                    class="mt-6 md:mt-0 group relative px-8 py-4 rounded-full flex items-center gap-3 transition-all duration-300 shadow-2xl backdrop-blur-md border border-white/20"
                    :class="isFavorite
                        ? 'bg-rose-500/80 hover:bg-rose-600/80 text-white'
                        : 'bg-white/10 hover:bg-white/20 text-white'"
                    :disabled="saveForm.processing"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform group-hover:scale-125 duration-300" :class="isFavorite ? 'fill-current' : 'fill-none stroke-current'" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="font-medium tracking-wide">{{ isFavorite ? 'Aimé' : 'Aimer ce lieu' }}</span>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">

                <div class="relative flex items-center justify-center lg:justify-start">
                    <img
                        :src="`https://openweathermap.org/img/wn/${weatherData.weather[0].icon}@4x.png`"
                        class="w-56 h-56 drop-shadow-2xl animate-float filter brightness-110"
                    >
                    <div class="flex flex-col ml-4">
                        <span class="text-9xl font-bold leading-none">{{ Math.round(weatherData.main.temp) }}°</span>
                        <span class="text-2xl font-light text-white/80 capitalize mt-2">{{ weatherData.weather[0].description }}</span>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-lg border border-white/10 p-8 rounded-3xl shadow-xl">
                    <p class="text-lg text-white/70 mb-2 font-serif italic">{{ greeting }}</p>
                    <p class="text-3xl font-light leading-relaxed">
                        "{{ humanAdvice }}"
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-black/10 hover:bg-white/5 transition duration-500 p-6 rounded-3xl border border-white/5 backdrop-blur-sm flex flex-col justify-between h-32">
                    <div class="text-white/50 text-xs font-bold uppercase tracking-widest">Humidité</div>
                    <div class="text-3xl font-medium">{{ weatherData.main.humidity }}<span class="text-lg align-top">%</span></div>
                </div>

                <div class="bg-black/10 hover:bg-white/5 transition duration-500 p-6 rounded-3xl border border-white/5 backdrop-blur-sm flex flex-col justify-between h-32">
                    <div class="text-white/50 text-xs font-bold uppercase tracking-widest">Vent</div>
                    <div class="text-3xl font-medium">{{ weatherData.wind.speed }} <span class="text-lg align-baseline text-white/60">km/h</span></div>
                </div>

                <div class="bg-black/10 hover:bg-white/5 transition duration-500 p-6 rounded-3xl border border-white/5 backdrop-blur-sm flex flex-col justify-between h-32">
                    <div class="text-white/50 text-xs font-bold uppercase tracking-widest">Ressenti</div>
                    <div class="text-3xl font-medium">{{ Math.round(weatherData.main.feels_like) }}°</div>
                </div>

                <div class="bg-black/10 hover:bg-white/5 transition duration-500 p-6 rounded-3xl border border-white/5 backdrop-blur-sm flex flex-col justify-between h-32">
                    <div class="text-white/50 text-xs font-bold uppercase tracking-widest">Pression</div>
                    <div class="text-3xl font-medium">{{ weatherData.main.pressure }} <span class="text-sm align-baseline text-white/60">hPa</span></div>
                </div>
            </div>

        </div>

        <div v-else class="text-center opacity-60 animate-pulse">
            <h2 class="text-4xl font-thin mb-4">L'aventure commence ici.</h2>
            <p class="text-xl font-light">Cherchez une destination pour voir le monde.</p>
        </div>
    </div>
</template>

<style scoped>
/* Animations douces */
@keyframes float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-15px) scale(1.05); }
}
.animate-float {
    animation: float 6s ease-in-out infinite;
}
.animate-fade-in {
    animation: fadeIn 0.8s ease-out forwards;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
