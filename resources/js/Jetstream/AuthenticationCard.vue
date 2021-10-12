<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-red-50">
        <div>
            <div class="flex justify-center items-center mt-6">
                <img class="rounded-full h-32 w-32 top-70%" src="/images/Logo_Deliti_R_A.png" alt="user avatar" align="justify-center" />
            </div>
            <br/>
        </div>
        <div class="flex flex-col bg-pink-100 shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-2 rounded-md w-full max-w-md">
            <slot />
        </div>
    </div>
</template>
