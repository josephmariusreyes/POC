/* generated using openapi-typescript-codegen -- do not edit */
/* istanbul ignore file */
/* tslint:disable */
/* eslint-disable */
import type { CancelablePromise } from '../core/CancelablePromise';
import { OpenAPI } from '../core/OpenAPI';
import { request as __request } from '../core/request';
export class EndpointsService {
    /**
     * @returns any
     * @throws ApiError
     */
    public static postApiLogin({
        requestBody,
    }: {
        requestBody: {
            /**
             * Must be a valid email address.
             */
            email: string;
            password: string;
            device_name?: string | null;
        },
    }): CancelablePromise<{
        success?: boolean;
        message?: string;
        data?: {
            id?: number;
            name?: string;
            email?: string;
            email_verified_at?: string;
            created_at?: string;
            updated_at?: string;
            mobile_number?: string;
            queue_session_id?: string | null;
        };
        meta?: string | null;
    }> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/login',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns any
     * @throws ApiError
     */
    public static postApiLogout(): CancelablePromise<{
        success?: boolean;
        message?: string;
        data?: any[];
        meta?: string | null;
    }> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/logout',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static getApiCompanies(): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/companies',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static postApiCompanies({
        requestBody,
    }: {
        requestBody: {
            /**
             * The <code>id</code> of an existing record in the companies table.
             */
            id?: number;
            name: string;
            /**
             * Must be a valid email address.
             */
            company_email: string;
            description: string;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/companies',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static getApiCompaniesId({
        id,
    }: {
        /**
         * The ID of the company.
         */
        id: string,
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/companies/{id}',
            path: {
                'id': id,
            },
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static putApiCompaniesId({
        id,
        requestBody,
    }: {
        /**
         * The ID of the company.
         */
        id: string,
        requestBody: {
            /**
             * The <code>id</code> of an existing record in the companies table.
             */
            id?: number;
            name: string;
            /**
             * Must be a valid email address.
             */
            company_email: string;
            description: string;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'PUT',
            url: '/api/companies/{id}',
            path: {
                'id': id,
            },
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static getApiUsers({
        requestBody,
    }: {
        requestBody: {
            companyId: number;
            role?: string | null;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/users',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static postApiUsers({
        requestBody,
    }: {
        requestBody: {
            /**
             * The <code>id</code> of an existing record in the users table.
             */
            id?: number;
            /**
             * Must not be greater than 255 characters.
             */
            name: string;
            /**
             * Must be a valid email address.
             */
            email: string;
            /**
             * Must be at least 8 characters.
             */
            password: string;
            /**
             * Must match the regex /^09\d{9}$/.
             */
            mobileNumber: string;
            companyId: number;
            role: 'SuperAdmin' | 'CompanyAdmin' | 'QueAdmin' | 'QueEncoder';
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/users',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static getApiUsersId({
        id,
        requestBody,
    }: {
        /**
         * The ID of the user.
         */
        id: number,
        requestBody: {
            id: number;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/users/{id}',
            path: {
                'id': id,
            },
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static putApiUsersId({
        id,
        requestBody,
    }: {
        /**
         * The ID of the user.
         */
        id: number,
        requestBody: {
            /**
             * The <code>id</code> of an existing record in the users table.
             */
            id?: number;
            /**
             * Must not be greater than 255 characters.
             */
            name: string;
            /**
             * Must be a valid email address.
             */
            email: string;
            /**
             * Must be at least 8 characters.
             */
            password: string;
            /**
             * Must match the regex /^09\d{9}$/.
             */
            mobileNumber: string;
            companyId: number;
            role: 'SuperAdmin' | 'CompanyAdmin' | 'QueAdmin' | 'QueEncoder';
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'PUT',
            url: '/api/users/{id}',
            path: {
                'id': id,
            },
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static deleteApiUsersId({
        id,
    }: {
        /**
         * The ID of the user.
         */
        id: number,
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'DELETE',
            url: '/api/users/{id}',
            path: {
                'id': id,
            },
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static getApiQueueSessions({
        requestBody,
    }: {
        requestBody: {
            companyId: number;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/queue-sessions',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static postApiQueueSessions({
        requestBody,
    }: {
        requestBody: {
            /**
             * Must not be greater than 255 characters.
             */
            name: string;
            /**
             * Must not be greater than 255 characters.
             */
            description: string;
            companyId: number;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/queue-sessions',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static getApiQueueSessionsId({
        id,
    }: {
        /**
         * The ID of the queue session.
         */
        id: string,
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/queue-sessions/{id}',
            path: {
                'id': id,
            },
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static putApiQueueSessionsId({
        id,
        requestBody,
    }: {
        /**
         * The ID of the queue session.
         */
        id: string,
        requestBody: {
            /**
             * Must not be greater than 255 characters.
             */
            name: string;
            /**
             * Must not be greater than 255 characters.
             */
            description: string;
            companyId: number;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'PUT',
            url: '/api/queue-sessions/{id}',
            path: {
                'id': id,
            },
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static deleteApiQueueSessionsId({
        id,
    }: {
        /**
         * The ID of the queue session.
         */
        id: string,
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'DELETE',
            url: '/api/queue-sessions/{id}',
            path: {
                'id': id,
            },
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static postApiQueueSessionsAddQueueUsers({
        requestBody,
    }: {
        requestBody: {
            userId: number;
            queueSessionId: number;
            companyId: number;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/queue-sessions/add-queue-users',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static deleteApiQueueSessionsRemoveQueueUser({
        requestBody,
    }: {
        requestBody: {
            userId: number;
            queueSessionId: number;
            companyId: number;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'DELETE',
            url: '/api/queue-sessions/remove-queue-user',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns any
     * @throws ApiError
     */
    public static getApiCustomers(): CancelablePromise<{
        success?: boolean;
        message?: string;
        data?: {
            id?: number;
            queue_session_id?: string | null;
            first_name?: string;
            last_name?: string;
            mobile_number?: string;
            created_at?: string;
            updated_at?: string;
            accepted_on?: string | null;
            ended_on?: string | null;
            que_number?: number;
            customer_status?: string;
        };
        meta?: string | null;
    }> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/customers',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static postApiCustomers({
        requestBody,
    }: {
        requestBody: {
            /**
             * Must not be greater than 255 characters.
             */
            firstName: string;
            /**
             * Must not be greater than 255 characters.
             */
            lastName: string;
            /**
             * Must match the regex /^09\d{9}$/.
             */
            mobileNumber: string;
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/customers',
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static getApiCustomersId({
        id,
    }: {
        /**
         * The ID of the customer.
         */
        id: number,
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/customers/{id}',
            path: {
                'id': id,
            },
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static putApiCustomersId({
        id,
        requestBody,
    }: {
        /**
         * The ID of the customer.
         */
        id: number,
        requestBody: {
            /**
             * The <code>id</code> of an existing record in the customer table.
             */
            id: number;
            customerStatus: 'Pending' | 'InProgress' | 'Done';
        },
    }): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'PUT',
            url: '/api/customers/{id}',
            path: {
                'id': id,
            },
            body: requestBody,
            mediaType: 'application/json',
        });
    }
    /**
     * @returns void
     * @throws ApiError
     */
    public static getApiAccessControlAppMenu(): CancelablePromise<void> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/access-control/app-menu',
        });
    }
}
