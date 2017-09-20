<template>
    <div>
        <nav class="navbar fixed-top navbar-light bg-light">
            <span class="navbar-brand">Sections: </span>
            <ul class="nav nav-pills mr-auto">
                <li v-for="section in sections" class="nav-item">
                    <a class="nav-link" :href="'#section-'+section.id">
                        {{ section.id }}
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['sections']
    }
</script>
