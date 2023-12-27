<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contacts
            </h2>
        </template>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1>Listado de Contactos</h1>
            <!--pre>
                {{props.contacts}}
            </pre-->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="px-6 py-4 flex items-center">
                    <TextInput v-model="search" type="text" class="flex-1" placeholder="Ingrese texto a filtrar"/>
                    <Link :href="route('contacts.create')" class="ml-4 flex-shrink-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Nuevo</Link>
                </div>
                
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                            Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Organization
                            </th>
                            <th scope="col" class="px-6 py-3">
                                City
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact in props.contacts.data" :key="contact.id"
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               {{contact.first_name + ' '+ contact.last_name }}
                            </th>
                            <td class="px-6 py-4">
                                {{contact.organization.name}}
                            </td>
                            <td class="px-6 py-4">
                                {{contact.city}}
                            </td>
                            <td class="px-6 py-4">
                                {{contact.phone}}
                            </td>
                            <td class="px-6 py-4">
                                <Link :href="route('contacts.edit',contact.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Edit</Link>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <Pagination :pagination="props.contacts" />

            </div>
        </div>
        
    </AppLayout>
    
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Shared/Pagination.vue'
import TextInput from '@/Components/TextInput.vue'
import { router, Link } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const props = defineProps({
    'contacts' : {
        type: Object,
        required: true
    },
    'filters': Object
});
let search = ref(props.filters.search)

watch(search,()=>{
    router.get('/contacts',{search: search.value},{preserveState:true,replace:true})
})

</script>

<style scoped>
</style>