product
.factory("LanguageService", [
    "$resource",
    "ROOT",
    function ($resource, ROOT) {
        return $resource(ROOT + "languages/:id", {
            id: "@id"
        });
    }
]);
