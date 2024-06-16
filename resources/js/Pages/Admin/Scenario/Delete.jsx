import { Head, usePage, useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import PrimaryButton from '@/Components/PrimaryButton';

export default function Delete({ auth, scenario }) {

    const { flash } = usePage().props

    const { delete: destroy, processing, errors } = useForm()

    const submit = (e) => {
        e.preventDefault()
        destroy(route('admin.scenario.destroy', scenario))
    }

    return (
        <AuthenticatedLayout user={auth.user} >
            <Head title="Excluir cenário de jogo" />
            <main className="w-4/5 sm:w-3/5 lg:w-2/5 m-auto mt-10 bg-white p-5 rounded-lg">
                <form onSubmit={submit}>
                <p className='text-center text-red-500'>Deseja mesmo excluir o cenário da aplicação?</p>
                    <div className="flex items-center justify-center mt-4">
                        <PrimaryButton disabled={processing} >
                            Excluir cenário
                        </PrimaryButton>
                    </div>
                </form>
             </main>
        </AuthenticatedLayout>
    )
}