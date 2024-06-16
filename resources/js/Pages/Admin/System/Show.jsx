import InputSuccess from '@/Components/InputSuccess';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';

export default function Show({ system, auth }) {

    const { flash } = usePage().props

    const createdAt = new Date(system.created_at);
    const updatedAt = new Date(system.updated_at);

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={system.name} />
            <InputSuccess message={flash.success} className='text-center mt-6' />
            <main className='text-center mt-10'>
                <h1 className='text-3xl'>{system.name}</h1>
                <h2 className='text-xl'>Gênero - {system.genre}</h2>
                <p>Criado em: {createdAt.toLocaleDateString()} - Atualizado em: {updatedAt.toLocaleDateString()}</p>
            </main>
        </AuthenticatedLayout>
    )
}