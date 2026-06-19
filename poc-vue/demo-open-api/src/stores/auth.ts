import { defineStore } from 'pinia';
import { authStorage } from '@/services/auth-storage';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null as any,
        token: authStorage.getToken(),
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
    },

    actions: {
        setToken(token: string) {
            this.token = token;
            authStorage.setToken(token);
        },

        logout() {
            this.user = null;
            this.token = null;

            authStorage.removeToken();
        },
    },
});