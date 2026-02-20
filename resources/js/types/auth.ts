export interface LoginData {
    email: string;
    password?: string;
    remember: boolean;
}

export type AuthResponse = {
    status: 'success' | 'error';
    message: string;
}