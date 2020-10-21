function LoadOtsukaLibraryVideoPopUp(FileLocation,modalId) {
        jwplayer("play_wrapper").setup({
            flashplayer: "/video/player.swf",
            autostart: true,
            file: FileLocation
        });
        $('#loadVideo').dialog({
            autoopen: true,
            modal: true,
            width: 425,
            height: 350
        });
        $('#'+modalId).dialog('open');
    }