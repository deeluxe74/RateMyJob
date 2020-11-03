<template>
    <div>
        <div class="head bg-black pt-2 pb-3 px-2">
            <router-link class="item1" :to="{name: 'CardList'}"><img  src="/img/svg/burn.svg" alt="Les plus populaires"></router-link>
            <div class="item2 d-flex align-items-end">
                <h2 class="m-0">BetterChoice</h2>
            </div>
            <router-link class="item3" :to="{name: 'Post'}"><img  src="/img/svg/new.svg" alt="Crée un post"></router-link>
        </div>
    </div>
</template>

<script>

export default {

}
</script>

<style scoped>
img {
    width: 50px;
}

.head {
    z-index: 10;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 13vh;
    display: grid;
    grid-template: auto / 25% 50% 25%;
    border-radius: 0 0 50% 50%;
    box-shadow: 9px 8px 15px 0px #000000b7;
}

.item1 {
    justify-self: center;
    grid-area: 1/1;
}
.item2 {
    justify-self: center;
    grid-area: 2/2;
}
.item3 {
    align-self: center;
    justify-self: center;
    grid-area: 1/3;
}

</style>