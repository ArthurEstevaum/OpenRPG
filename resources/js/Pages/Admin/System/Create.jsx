import InputError from "@/Components/InputError"
import InputLabel from "@/Components/InputLabel"
import InputSuccess from "@/Components/InputSuccess"
import TextInput from "@/Components/TextInput"
import PrimaryButton from "@/Components/PrimaryButton"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout"
import { useForm, usePage, Head } from "@inertiajs/react"

export default function Create({ auth }) {

    const { flash } = usePage().props

    const { data, setData, post, processing, errors } = useForm({
        name: '',
        genre: '',
    })

    const submit = (e) => {
        e.preventDefault()

        post(route('admin.system.store'))
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Criar Sistema" />
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
                        <InputLabel htmlFor="genre" value="Gênero" />
                        <TextInput
                            id="genre"
                            type="text"
                            name="genre"
                            value={data.genre}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('genre', e.target.value)}
                            required
                        />
                        <InputError message={errors.genre} className="mt-2" />
                    </div>
                    <div className="flex items-center justify-end mt-4">
                        <PrimaryButton className="ml-4" disabled={processing}>
                            Criar
                        </PrimaryButton>
                    </div>
                </form>
            </main>
        </AuthenticatedLayout>
    )
}