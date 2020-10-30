<template>
    <div class="full-margin">
        <div class="px-3 d-flex flex-column align-items-end">
            <textarea class="bg-pink-flash mt-5" rows="5"></textarea>
            <input type="text" class="bg-pink-flash mt-4">
            <img class="mt-4 mr-2" src="/img/svg/new.svg" alt="Ajouter une photo supplémentaire">
        </div>

        <div class="bloc-post bg-pink-flash mt-5">
            <div class="forme bg-black">
                <h2>POSTER</h2>
            </div>
            <p>
                Poster jusqu'à 3 images, grace a cela vous n'aurez plus de doute sur votre choix !
            </p>
            <p>
                Poster des styles, couleurs, nom, typo … absolument tout a partir du moment ou vous hésiter.
            </p>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
textarea {
    border: none;
    width: 80vw;
    border-radius: 15px;
}

input {
    border: none;
    width: 65vw;
    border-radius: 10px;
    height: 3rem;
}

input:focus, textarea:focus
{   
    color: white;
    outline: none;
    box-shadow: 9px 8px 15px 0px #000000b7;
    transform: scale(1.05);
    transition: all 200ms linear;
}

img {
    width: 3.8rem;
}

.forme {
    box-shadow: 9px 8px 15px 0px #000000b7;
    width: 100%;
    height: 8vh;
    border-bottom-left-radius: 200px 120%;
    border-bottom-right-radius: 200px 120%;
}

.bloc-post {
    padding: inherit;
}
</style>