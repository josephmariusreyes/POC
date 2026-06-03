<template>
    <SidebarProvider>
        <CustomerListSideBar />
        <SidebarInset>
            <!--
            flex: Uses flexbox layout for the header container.
            h-16: Sets the header height to 4rem.
            shrink-0: Prevents the header from shrinking when space is tight.
            items-center: Vertically centers children along the cross axis.
            gap-2: Adds 0.5rem spacing between direct children.
            transition-[width,height]: Animates width and height changes.
            ease-linear: Uses a constant animation speed.
            group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12: Reduces header height to 3rem when the sidebar wrapper group contains the icon-collapsed state.
            text-foreground: Applies the theme foreground text color.
            -->
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
            auth-layout-background: Applies the custom auth layout background style.
            -->
            <div class="flex flex-1 flex-col gap-4 p-4 pt-0 text-foreground ">
                <div class="rounded-xl bg-muted/50 p-6 space-y-4">
                    <CustomerListFilter v-model="query" />
                    <CustomerListTable :query="query" />
                </div>
            </div>
        </SidebarInset>
    </SidebarProvider>
</template>

<script setup lang="ts">
import { ref } from 'vue'

import CustomerListFilter from '@/features/customers/components/CustomerListFilter.vue'
import CustomerListSideBar from '@/features/customers/components/CustomerListSideBar.vue'
import CustomerListTable from '@/features/customers/components/CustomerListTable.vue'

import {
    SidebarInset,
    SidebarProvider,
    SidebarTrigger,
} from '@/components/ui/sidebar'

const query = ref('')
</script>