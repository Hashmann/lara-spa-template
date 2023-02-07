<template>
    <div class="d-flex align-center">
        <v-checkbox
            v-model="checkbox"
            color="info"
        ></v-checkbox>
        <span>Я согласен с правилами регистрации</span>
    </div>
</template>

<script>
export default {
    name: "Rules",
    data: () => ({
        checkbox: false,
    }),
}
</script>

<style scoped lang="scss">
.v-input__details {
    display: none;
}
.v-input--horizontal {
    display: contents;
}

</style>
