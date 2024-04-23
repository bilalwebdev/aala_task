<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    pagination: Object,
});
</script>

<template>
    <div class="m-2">
        <nav class="pagination is-centered" role="navigation" aria-label="pagination">
            <ul class="flex justify-start items-start gap-2 bg-white p-2 shadow-sm rounded">
                <template v-for="link in pagination.links" :key="link.label">
                    <li v-if="link.label === '...'" :key="link.label">
                        <span class="pagination-ellipsis">&hellip;</span>
                    </li>
                    <li v-else :key="link.label">
                        <Link preserve-scroll preserve-state class="pagination-link"
                            :aria-label="'Goto page ' + link.label" :class="{
                                'z-10 text-indigo-50 border-indigo-500 bg-indigo-600 py-1 px-2 rounded': link.active,
                                'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 py-1 px-2 rounded': !link.url,
                            }" :aria-current="link.active ? 'page' : null" :href="link.url || null"
                            v-html="link.label" />
                    </li>
                </template>
            </ul>
        </nav>
    </div>
</template>
