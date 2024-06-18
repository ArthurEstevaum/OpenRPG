import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage, useForm, router } from "@inertiajs/react"
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Edit({ scenario, auth }) {

    const { flash } = usePage().props

    const { data, setData, put, processing, errors } = useForm({
        name: scenario.name,
        system: scenario.system.name,
    })

    const submit = (e) => {
        e.preventDefault()
        put(route('admin.scenario.update', scenario), {
            preserveScroll:'errors'
        })
    }

    return (
        <AuthenticatedLayout user={auth.user} >
            <Head title="Editar cenário" />
            <main className="w-4/5 sm:w-3/5 lg:w-2/5 m-auto mt-10">
                <form onSubmit={submit}>
                    <div>
                        <InputLabel htmlFor="name" value="Nome" />
                        <TextInput
                          id="name"
                          name="name"
                          type="text"
                          value={data.name}
                          className="mt-1 block w-full"
                          isFocused={true}
                          required
                          onChange={(e) => setData('name', e.target.value)}
                        />
                        <InputError message={errors.name} className="mt-2" />
                    </div>
                    <div className="mt-4">
                        <InputLabel htmlFor="system" value="Sistema" />
                        <TextInput
                            id="system"
                            type="text"
                            name="system"
                            value={data.system}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('system', e.target.value)}
                            required
                        />
                        <InputError message={errors.system} className="mt-2" />
                    </div>
                    <div className="flex items-center justify-end mt-4">
                        <PrimaryButton className="ml-4" disabled={processing}>
                            Atualizar
                        </PrimaryButton>
                    </div>
                </form>
            </main>
        </AuthenticatedLayout>
    )
}