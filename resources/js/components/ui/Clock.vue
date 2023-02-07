<template>
    <p class="ml-2">{{this.time}}</p>
</template>

<script>
export default {
    name: "Clock",
    data: () => ({
        //INFO Часы
        interval: null,
        time: null,
    }),
    beforeDestroy() {
        // prevent memory leak
        clearInterval(this.interval)
    },
    created() {
        // update the time every second
        this.interval = setInterval(() => {
            // Concise way to format time according to system locale.
            // In my case this returns "3:48:00 am"
            this.time = Intl.DateTimeFormat(navigator.language, {
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            }).format()
        }, 1000)
    }
}
</script>

<style scoped>

</style>
