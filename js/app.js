
(function($) {

  $(document).ready(function () {
    if ($('select.selected').length > 0) {
      $('select.selected').select2();
      //                $( document.body ).on( "click", function() {
      //                    $( 'select' ).select2();
      //                });
    }

    if ($('select.selectedComp').length > 0) {

      $('select.selectedComp').select2({
        maximumSelectionLength: 10
      });
      //                $( document.body ).on( "click", function() {
      //                    $( 'select' ).select2();
      //                });
    }

    window.initDataTableMember = function () {

      var settings = {
        "destroy": true,
        "scrollCollapse": true,
        "searching": true,
        "language": {
          "processing": "Traitement en cours...",
          "search": "",
          "searchPlaceholder": "Recherche ....",
          "lengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
          "info": "Affichage de  _START_ &agrave; _END_ sur _TOTAL_ ",
          "infoEmpty": "Affichage de 0 &agrave; 0 sur 0 ",
          "infoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
          "infoPostFix": "",
          "loadingRecords": "Chargement en cours...",
          "zeroRecords": "<h3 class='uk-margin-top uk-margin-bottom'>Aucun &eacute;l&eacute;ment &agrave; afficher</h3>",
          "emptyTable": "<h3 class='uk-margin-top uk-margin-bottom'>Aucune donn&eacute;e disponible</h3>",
          "paginate": {
            "first": "",
            "previous": "",
            "next": "",
            "last": ""
          },
          "aria": {
            "sortAscending": ": activer pour trier la colonne par ordre croissant",
            "sortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
          }
        },
        "pageLength": 10,
        "columnDefs": [{
          "orderable": false,
          "searchable": false,
          "targets": 2
        },
          {
            "orderable": true,
            "searchable": false,
            "targets": 1
          }
        ]

      }

      $('.dataTableMember').dataTable(settings);

      var settings2 = {
        "destroy": true,
        "scrollCollapse": true,
        "searching": false,
        "language": {
          "processing": "Traitement en cours...",
          "search": "",
          "searchPlaceholder": "Recherche ....",
          "lengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
          "info": "Affichage de  _START_ &agrave; _END_ sur _TOTAL_ ",
          "infoEmpty": "Affichage de 0 &agrave; 0 sur 0 ",
          "infoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
          "infoPostFix": "",
          "loadingRecords": "Chargement en cours...",
          "zeroRecords": "<h3 class='uk-margin-top uk-margin-bottom'>Aucun &eacute;l&eacute;ment &agrave; afficher</h3>",
          "emptyTable": "<h3 class='uk-margin-top uk-margin-bottom'>Aucune donn&eacute;e disponible</h3>",
          "paginate": {
            "first": "",
            "previous": "",
            "next": "",
            "last": ""
          },
          "aria": {
            "sortAscending": ": activer pour trier la colonne par ordre croissant",
            "sortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
          }
        },
        "pageLength": 10,

      }

      $('.dataTableMember2').dataTable(settings2);
    }

    initDataTableMember();


    $('body').on('click', '.modal', function (e) {
      e.preventDefault();
      var url = $(this).attr('href');

      UIkit.modal($('#modal')).hide();
      UIkit.modal($('#modal')).show();

      $.ajax({
        method: "GET",
        url: url
      })
          .done(function (msg) {
            $('#modal .uk-body-custom').html(msg);
          });

    });


    $('#modal').on('hide', function () {
      $('#modal .uk-body-custom').html('<div class="uk-text-center uk-height-1-1 uk-flex-middle uk-padding"><div uk-spinner></div><h1 style="color: #000;" class="uk-margin-remove">Chargement</h1></div>');
    });

    $("body").on('click', 'a', function () {
      window.onbeforeunload = null;
    });


  });

})( jQuery );


