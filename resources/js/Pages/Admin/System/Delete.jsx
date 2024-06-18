import { Head, usePage, useForm } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Delete({ auth, system }) {

    const { flash } = usePage().props

    const { delete: destroy, processing, errors } = useForm()

    const submit = (e) => {
        e.preventDefault()
        destroy(route('admin.system.destroy', system))
    }

    return (
        <AuthenticatedLayout user={auth.user} >
            <Head title="Excluir sistema de jogo" />
             <main className="w-4/5 sm:w-9/12 lg:w-8/12 m-auto mt-10 bg-white p-5 rounded-lg">
                <form onSubmit={submit}>
                <p className='text-center text-red-500'>Deseja mesmo excluir o sistema <span className="text-lg font-bold">{system.name}</span> da aplicação?</p>
                    <div className="flex items-center justify-center mt-4">
                        <PrimaryButton disabled={processing} >
                            Excluir sistema
                        </PrimaryButton>
                    </div>
                </form>
             </main>
        </AuthenticatedLayout>
    )
}