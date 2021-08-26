/********************************************
 *               Multiple Files              *
 ********************************************/
Dropzone.options.dpzMultipleFiles = {
    paramName: "fichier", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    clickable: true,
    addRemoveLinks: true,
    dictRemoveFile: " Trash",
    maxThumbnailFilesize: 1, // MB
    acceptedFiles: 'image/jpg,image/jpeg,image/png,application/pdf',
    init: function () {

        // Using a closure.
        var _this = this;

        // Setup the observer for the button.
        $("#clear-dropzone").on("click", function () {
            // Using "_this" here, because "this" doesn't point to the dropzone anymore
            _this.removeAllFiles();
            // If you want to cancel uploads as well, you
            // could also call _this.removeAllFiles(true);
        });
    }
}