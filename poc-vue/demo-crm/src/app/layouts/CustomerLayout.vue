<script setup lang="ts">
import { RouterView } from 'vue-router'
</script>

<template>
	<!--
		Use <template> in a Vue SFC when you need to describe what the component should render.
		In this layout, the template is the visual shell for the /customers route and RouterView
		tells Vue where to render the matched child page, such as listing or details.
	-->
    <!--
        min-h-screen: sets the minimum height to 100vh so the wrapper fills the full screen height.
        text-foreground: applies the theme's foreground text color to everything inside this div.
    -->
    <div
        class="min-h-screen
        text-foreground
        auth-layout-background
        "
    >
		<RouterView />
	</div>
</template>
