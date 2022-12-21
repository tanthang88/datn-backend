import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/comment/list.js",
                "resources/js/comment/show.js",
                "resources/js/components/confirmDel.js",
                "resources/js/components/AjaxRequest.js",
                "resources/js/components/confirmEnd.js",
                "resources/js/components/dataTable.js",
                "resources/js/contact/countNotification.js",
                "resources/js/contact/list.js",
                "resources/js/dealsock/add.js",
                "resources/js/dealsock/edit.js",
                "resources/js/discount/add.js",
                "resources/js/discount/edit.js",
                "resources/js/discountcode/list.js",
                "resources/js/feeship/list.js",
                "resources/js/order/add.js",
                "resources/js/order/edit.js",
                "resources/js/role/add.js",
                "resources/js/role/list.js",
                "resources/js/staff/list.js",
                "resources/js/user/edit.js",
                "resources/js/user/list.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            $: "jQuery",
        },
    },
});
