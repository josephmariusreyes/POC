<template>
    <SidebarProvider>
        <CustomerListSideBar />
        <SidebarInset>
            <header
                class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12 text-foreground">
                <div class="flex items-center gap-2 px-4">
                    <SidebarTrigger class="-ml-1" />
                </div>
            </header>
            <!--
            flex: Uses flexbox layout for the container.
            flex-1: Lets this section grow and fill the remaining available space.
            flex-col: Stacks child elements vertically.
            gap-4: Adds 1rem spacing between child elements.
            p-4: Adds 1rem padding on all sides.
            pt-0: Removes top padding while keeping the other padding values.
            text-foreground: Applies the theme foreground text color.
            -->
            <div class="flex flex-1 flex-col gap-4 p-4 pt-0 text-foreground ">
                <!--
                rounded-xl: Applies an extra-large rounded corner radius.
                bg-muted/50: Uses the muted theme color at 50% opacity for the background.
                p-6: Adds 1.5rem padding on all sides.
                -->
                <div class="rounded-xl bg-muted/50 p-6">
                    <h1 class="text-2xl font-semibold">Create Customer</h1>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Customer creation form goes here.
                    </p>
                </div>
            </div>
        </SidebarInset>
    </SidebarProvider>
</template>

<script setup lang="ts">
import CustomerListSideBar from '@/features/customers/components/CustomerListSideBar.vue'

import {
    SidebarInset,
    SidebarProvider,
    SidebarTrigger,
} from '@/components/ui/sidebar'
</script>