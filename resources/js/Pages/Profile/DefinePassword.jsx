import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import DefinePasswordForm from './Partials/DefinePasswordForm';
import { Head, usePage } from '@inertiajs/react';
import InputError from '@/Components/InputError';

export default function DefinePassword({ auth }) {
    const { flash } = usePage().props
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">App Password</h2>}
        >
            <Head title="Profile" />

            <div className="py-4">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                    <InputError message={flash.error} />
                    
                    <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <DefinePasswordForm className="max-w-xl" />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}