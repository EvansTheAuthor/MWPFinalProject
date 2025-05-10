<template>
    <div class="menu-links">
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/Login">Login</RouterLink>
        <RouterLink to="/HelloWorld">Test</RouterLink>
    </div>
</template>

<style>
.menu-links{
    width: 100%;
    height: 60px;
    background-color: #800000;
    display: flex;
    align-items: center;
    padding: 0 1rem;
}

.menu-links a{
    text-decoration: none;
    color: #fff;
    margin-right: 30px;
}
</style>