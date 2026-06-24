import { EndpointsService } from '@/api';
import { useAuthStore } from '@/stores/auth';

export async function login(
    email: string,
    password: string,
) {
    const auth = useAuthStore();

    const response = await EndpointsService.postApiLogin({
        requestBody: {
            email: email,
            password: password,
            device_name: null
        }
    }); ``

    auth.setToken(response.meta.token);
    auth.user = response.data;

    return response;
}