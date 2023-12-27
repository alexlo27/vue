<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contacts
            </h2>
        </template>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-3xl">
            <h1>Contacts / Create</h1>
            <div class="bg-white px-6 py-8 rounded-lg shadow">
                {{ $page.props.errors}}
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label>
                            First Name
                            <TextInput v-model="contact.first_name" type="text" class="w-full" />
                        </label>
                    </div>
                    <div>
                        <label>
                            Last Name
                            <TextInput v-model="contact.last_name" type="text" class="w-full" />
                        </label>
                    </div>
                    <div>
                        <label>
                            Organización
                            <!--TextInput v-model="contact.organization_id" type="text" class="w-full" /-->
                            <select v-model="contact.organization_id" class="w-full">
                                <option value="" disabled selected >--- Seleccione ---</option>
                                <option :value="organization.id" v-for="organization in props.organizations" :key="organization.id">{{ organization.name }}</option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <label>
                            Email
                            <TextInput v-model="contact.email" type="text" class="w-full" />
                        </label>
                    </div>
                    <div>
                        <label>
                            Phone
                            <TextInput v-model="contact.phone" type="text" class="w-full" />
                        </label>
                    </div>
                    <div>
                        <label>
                            Address
                            <TextInput v-model="contact.address" type="text" class="w-full" />
                        </label>
                    </div>
                    <div>
                        <label>
                            City
                            <TextInput v-model="contact.city" type="text" class="w-full" />
                        </label>
                    </div>
                    <div>
                        <label>
                            State
                            <TextInput v-model="contact.state" type="text" class="w-full" />
                        </label>
                    </div>
                    <div>
                        <label>
                            Country
                            <!--TextInput v-model="contact.country_id" type="text" class="w-full" /-->
                            <select v-model="contact.country_id" class="w-full">
                                <option value="" disabled selected >--- Seleccione ---</option>
                                <option  :value="country.id" v-for="country in props.countries" :key="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <label>
                            Postal Code
                            <TextInput v-model="contact.postal_code" type="text" class="w-full" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button @click="store" class=" mt-3 ml-4 flex-shrink-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Crear
                </button>
            </div>
        </div>
    </AppLayout>
    
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import { router } from '@inertiajs/vue3'

let contact = {
    first_name: '',
    last_name: '',
    organization_id: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    state: '',
    country_id: '',
    postal_code: ''
}

const props = defineProps({
    organizations : Array,
    countries: Array
})

const store = () => {
    router.post(route('contacts.store'), contact)
}
</script>

<style scoped>
</style>