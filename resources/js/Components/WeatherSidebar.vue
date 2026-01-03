<script setup>
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    favorites: Array,
    errors: Object,
    flash: Object
});

const form = useForm({ city: '' });

const submitSearch = () => {
    form.post(route('meteo.search'), {
        onFinish: () => form.reset('city'),
    });
};

const loadFavorite = (cityName) => {
    form.city = cityName;
    submitSearch();
};

const deleteFavorite = (id) => {
    // Suppression douce sans l'alerte native du navigateur qui fait "robot"
    // On garde confirm() pour l'instant pour la simplicité, mais on pourrait faire une modale custom.
    if (confirm('Voulez-vous oublier ce lieu ?')) {
        router.delete(route('meteo.destroy', id), { preserveScroll: true });
    }
};
</script>

<template>
    <div class="w-full md:w-1/3 lg:w-1/4 bg-black/20 backdrop-blur-xl border-r border-white/10 p-8 flex flex-col h-screen overflow-y-auto z-20 shadow-2xl">

        <a href="/" class="mb-10 flex items-center gap-3 group cursor-pointer opacity-90 hover:opacity-100 transition">
            <div class="bg-white/20 p-2.5 rounded-2xl shadow-inner group-hover:scale-110 transition duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                </svg>
            </div>
            <span class="text-2xl font-light tracking-wide font-serif">SkyCast</span>
        </a>

        <form @submit.prevent="submitSearch" class="relative mb-8 group">
            <input
                v-model="form.city"
                type="text"
                placeholder="Explorer une ville..."
                class="w-full bg-white/10 border border-white/10 rounded-2xl py-4 px-6 pl-12 focus:outline-none focus:bg-white/20 focus:border-white/30 transition shadow-lg placeholder-white/50 text-white"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-white/70 group-hover:text-white transition pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </form>

        <div v-if="errors.city" class="mb-4 p-4 bg-red-500/30 backdrop-blur-md rounded-2xl border border-red-500/20 text-white text-sm text-center">
            Oups ! {{ errors.city }}
        </div>
        <div v-if="flash?.message" class="mb-4 p-4 bg-emerald-500/30 backdrop-blur-md rounded-2xl border border-emerald-500/20 text-white text-sm text-center animate-fade-in-up">
            ✨ {{ flash.message }}
        </div>

        <div class="flex-1">
            <h3 class="text-xs font-bold text-white/40 uppercase tracking-widest mb-6 px-2">Vos Escales</h3>

            <div v-if="favorites && favorites.length > 0" class="space-y-3">
                <div
                    v-for="fav in favorites"
                    :key="fav.id"
                    class="group flex items-center justify-between p-4 rounded-2xl hover:bg-white/10 transition duration-300 border border-transparent hover:border-white/5 cursor-pointer"
                    @click="loadFavorite(fav.city)"
                >
                    <span class="font-medium text-lg text-white/90 group-hover:translate-x-1 transition duration-300">{{ fav.city }}</span>

                    <button
                        @click.stop="deleteFavorite(fav.id)"
                        class="opacity-0 group-hover:opacity-100 text-white/40 hover:text-red-300 p-2 transition duration-300"
                        title="Oublier"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <div v-else class="flex flex-col items-center justify-center h-40 text-white/30 text-center px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <p class="text-sm">Aucune destination favorite.</p>
            </div>
        </div>

        <div class="mt-6 pt-6 border-t border-white/10">
            <a href="/" class="flex items-center justify-center gap-2 text-sm text-white/50 hover:text-white transition group">
                <span class="group-hover:-translate-x-1 transition">&larr;</span> Retour à l'accueil
            </a>
        </div>
    </div>
</template>
