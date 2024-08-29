<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

defineProps({
    orders: {
        type: Object,
        required: true,
    },
    msj_success: {
        type: String,
        required: false,
    },
});
</script>

<template>
    <AppLayout>
        <template #header> </template>
        <div class="w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5">
            <div class="flex justify-between mb-5">
                <h1
                    class="flex font-semibold text-md text-gray-700 leading-tigh"
                >
                    Ordenes
                </h1>
            </div>
            <!-- PANEL INDEX -->
            <div
                class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="w-full mb-1">
                    <div class="sm:flex">
                        <div
                            class="flex items-center ml-auto space-x-2 sm:space-x-3"
                        >
                            <Link
                                :href="route('orders.create')"
                                class="w-full inline-flex mx-3 items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <svg
                                    class="w-5 h-5 mr-2 -ml-1"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                Nueva Orden
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <!--END PANEL INDEX-->
            <div class="overflow-auto rounded-t-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">FECHA</th>
                                <th scope="col" class="px-6 py-3">MONTO</th>
                                <th scope="col" class="px-6 py-3">STATUS</th>
                                <th scope="col" class="px-6 py-3">PAGAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(order, index) in orders.data"
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    {{ formatdate(order.created_at) }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ order.total_amount }}
                                </td>
                                <td class="px-6 py-4">
                                    {{
                                        order.payment_status == 0
                                            ? "PENDIENTE"
                                            : "PAGADA"
                                    }}
                                </td>

                                <td class="px-6 py-4">
                                    <button
                                        v-if="order.payment_status == 0"
                                        @click="gocheckout(order)"
                                        type="button"
                                        class="inline-flex items-center p-1 font-medium text-center text-white rounded-lg focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                                    >
                                        <svg
                                            class="h-8 w-8 text-green-500"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                    </button>

                                    <button
                                        v-else
                                        @click="gocheckout(order)"
                                        type="button"
                                        class="inline-flex items-center p-1 font-medium text-center text-white rounded-lg focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                                        disabled
                                    >
                                        <svg
                                            class="h-8 w-8 text-gray-500"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div
                        class="bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between"
                    >
                        <div class="flex items-center mb-4 sm:mb-0">
                            <Link
                                v-if="orders.current_page > 1"
                                :href="orders.prev_page_url"
                                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                                <svg
                                    class="w-7 h-7"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </Link>
                            <Link
                                v-if="orders.current_page < orders.last_page"
                                :href="orders.next_page_url"
                                class="inline-flex justify-center p-1 mr-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                                <svg
                                    class="w-7 h-7"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </Link>
                            <span
                                class="text-sm font-normal text-gray-500 dark:text-gray-400"
                                >Mostrando
                                <span
                                    class="font-semibold text-gray-900 dark:text-white"
                                    >{{ orders.from }}-{{ orders.to }}</span
                                >
                                De
                                <span
                                    class="font-semibold text-gray-900 dark:text-white"
                                    >{{ orders.total }}</span
                                ></span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    name: "OrdersIndex",

    data() {
        return {};
    },

    async mounted() {
        if (this.msj_success) {
            alert(this.msj_success);
        }
        return;
    },

    methods: {
        formatdate(date) {
            const datef = new Date(date);
            return datef.toDateString();
        },

        gocheckout(order) {
            router.visit("orders/checkout", {
                method: "post",
                data: {
                    amount: order.total_amount,
                    order_id: order.id,
                },
                preserveState: true,
                preserveScroll: true,

                onSuccess: (resp) => {
                    console.log(resp.props.jetstream.flash.checkoutlink);
                    window.location.href =
                        resp.props.jetstream.flash.checkoutlink;
                    return;
                },
                onError: (errors) => {
                    console.log("erros");
                    return;
                },
            });
        },
    },
};
</script>
