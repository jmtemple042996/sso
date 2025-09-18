<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <AppLayout title="James M. Temple">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                James M. Temple
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex dark:text-gray-300 justify-between">
                    <div class="px-4 py-4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="dark:text-gray-300 font-bold text-lg mb-4">Google Account</div>

                        <div v-if="$page.props.auth.user.google_id == null">No account linked.
                            <a :href="route('auth.external.redirect','google')"><div class="mt-4"><PrimaryButton>Link Account</PrimaryButton></div></a>
                        </div>
                        <div v-else>
                            <div><span class="ml-2 font-bold ">Google Username:</span> {{ $page.props.auth.user.google_username }}</div>
                            <a :href="route('auth.external.unlink','google')"><DangerButton class="mt-4">Unlink Account</DangerButton></a>

                        </div>
                    </div>
                    <div class="px-4 py-4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="dark:text-gray-300 font-bold text-lg mb-4">Github Account</div>

                        <div v-if="$page.props.auth.user.github_id == null">No account linked.
                            <a :href="route('auth.external.redirect','github')"><div class="mt-4"><PrimaryButton>Link Account</PrimaryButton></div></a>
                        </div>
                        <div v-else>
                            <div><span class="ml-2 font-bold ">Github Username:</span> {{ $page.props.auth.user.github_username }}</div>
                            <a :href="route('auth.external.unlink','github')"><DangerButton class="mt-4">Unlink Account</DangerButton></a>

                        </div>
                    </div>
                    <div class="px-4 py-4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                                                <div class="dark:text-gray-300 font-bold text-lg mb-4">Slack Account</div>


                        <div v-if="$page.props.auth.user.slack_id == null">No account linked.
                            <a :href="route('auth.external.redirect','slack')"><div class="mt-4"><PrimaryButton>Link Account</PrimaryButton></div></a>
                        </div>
                        <div v-else>
                            <div><span class="ml-2 font-bold ">Slack Username:</span> {{ $page.props.auth.user.slack_username }}</div>
                            <a :href="route('auth.external.unlink','slack') "><DangerButton  class="mt-4">Unlink Account</DangerButton></a>

                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                </div>
            </div>
        </div>
    </AppLayout>
</template>
