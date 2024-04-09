import InputSuccess from "@/Components/InputSuccess"
import { useForm, usePage } from "@inertiajs/react"

export default function Create() {

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
        <main>
            <InputSuccess message={flash.success} />
            <form onSubmit={submit}>
                
            </form>
        </main>
    )
}