<template>
    <div>
        <div class="frame-illustration">
            <img class="illustation" src="/img/svg/exemple.jpg" alt="Illustration de la demande">
        </div>
        <div class="forme bg-black d-flex flex-row justify-content-between align-items-start">
            <div class="d-flex flex-row align-items-center">
                <img src="/img/svg/heart.svg" alt="Nombre de like">
                <div>
                    <h2>103</h2>
                </div>
            </div>
            <h3 class="align-self-center mt-3">30%</h3>
            <div class="d-flex flex-row align-items-center">
                <img src="/img/svg/heart-empty.svg" alt="Nombre de dislike">
                <div>
                    <h2>108</h2>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center">
            <div class="circle bg-white"></div>
            <div class="circle bg-pink-flash"></div>
            <div class="circle bg-white"></div>
            <div class="circle bg-white"></div>
        </div>

        <div class="d-flex flex-column talk bg-pink-flash p-3">
            <div class="d-flex flex-row align-items-center">
                <img class="mr-2" src="/img/svg/chat.svg" alt="Nombre de commentaire">
                <h4>Commentaires</h4>
            </div>

            <div class="align-self-end message bg-pink px-3 py-2 my-2">
                <h4 class="name">Paul</h4>
                <p>Amazing, i like it. I want more shoot like that !</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
h3 {
    font-size: 2.3rem;
}

h2 {
    font-size: 1.8rem;
}

img {
    width: 3rem;
}

.name {
    font-size: 1.8rem;
}

.message {
    border-radius: 15px;
    max-width: 80vw;
    width: max-content;
}

.circle {
    margin: 3vh 2vw;
    width: 11vw;
    height: 11vw;
    border-radius: 50%;
}

.frame-illustration {
    overflow: hidden;
    width: 100vw;
    max-height: 80vh;
}

.illustation {
    position: relative;
    top: 8vh;
    width: 100%;
}

.forme {
    box-shadow: 9px 8px 15px 0px #000000b7;
    width: 100%;
    height: 11vh;
    border-bottom-left-radius: 200px 120%;
    border-bottom-right-radius: 200px 120%;
    padding: 4% 10%;
}
</style>