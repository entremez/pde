@extends('layouts.puente')

@section('title', 'Encuesta')
@section('title-providers', 'title-survey-crud')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 mt-5  section">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Área</th>
                <th>Opción</th>
                <th>Recomendación</th>
                <!--<th>Acciónes</th>-->
            </tr>
        </thead>
        <tbody>
         @foreach($recommendations as $recommendation) 
            <tr>
              <td>{{ $areas[$recommendation->options->statement_id] }}</td>
              <td>{{ $recommendation->options->option }}</td>
              <td>{{ $recommendation->services->name }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" role="dialog" id="myModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar sentencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

        
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="statementEdit">Sentencia</label>
                <textarea class="form-control" id="statementEdit" name="statement"></textarea>
              </div>
            </div>
          </div>

          <div class="mb-3 dm-uploader mt-5" >
            <div class="form-row">
              <div class="col-md-9 col-sm-12 align-grid-r">
                <div class="from-group mb-2">
                  <label>Cambia la imagen de fondo de la pregunta&nbsp;&nbsp;&nbsp;<small>(Formatos permitidos: jpeg, png, bmp, gif o svg)</small></label>
                  <div class="errorLogo"></div>
                  <input required type="text" class="form-control" aria-describedby="fileHelp" placeholder="Selecciona una imagen..." readonly="readonly" id="image-data" />

                  <div class="progress mb-2 d-none">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                      role="progressbar"
                      style="width: 0%;" 
                      aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
                      0%
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <div role="button" class="btn btn-primary mr-2">
                    Examinar archivos
                    <input type="file" id="file-input" name="image" />
                  </div>
                  <small class="status text-muted">Busca la imagen en tus archivos</small>
                </div>
              </div>
              <div class="col-md-3  d-md-block  d-sm-none align-grid">
                <img src="" alt="sin imagen" class="img-thumbnail w-100" id="imgSalida">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="typeEdit">Tipo</label>
                <input class="form-control" id="typeEdit" disabled> 
              </div>
            </div>
          </div>

        <div class="row mt-3">
          <div class="col">
            <div class="form-group">
              <label for="linkEdit">Opciones</label>
              <div id="options"></div>
            </div>
          </div>
        </div>         
          <input required type="hidden" id="id" name="id" value="">
        
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit"  class="btn btn-primary">Guardar cambios</button>
      </div>
    </form>
    </div>
  </div>
</div>


@include('partials/footer')

@endsection

@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').removeAttr('width').DataTable({
      "order": [],
      'rowsGroup': [0 ,1]
    });

    $(document).on('click', '#edit-statement', function(event) {

      var public_path = window.location.host+'/images/'+$(this).data('data')['background'];
      $('#statementEdit').val($(this).data('data')['statement']);
      $('#typeEdit').val($(this).data('type'));
      $('#id').val($(this).data('id'));
      var out = `
          <div class="row">
            <div class="col">
              <div class="form-group">`;

      for (var i = 0; i < $(this).data('options').length; i++) {
          out += '<textarea name="option['+ $(this).data('options')[i]['id'] +']" class="form-control">'+$(this).data('options')[i]['option'] + '</textarea>';
      }
      out+=` </div>
            </div>
          </div>`;
      $('#options').html(out);
      $('#imgSalida').removeAttr('src');
      $('#imgSalida').attr("src", 'http://'+public_path);
      $('#myModal').modal('show');
    });

} );


/*! RowsGroup for DataTables v2.0.0
 * 2015-2016 Alexey Shildyakov ashl1future@gmail.com
 * 2016 Tibor Wekerle
 */

/**
 * @summary     RowsGroup
 * @description Group rows by specified columns
 * @version     2.0.0
 * @file        dataTables.rowsGroup.js
 * @author      Alexey Shildyakov (ashl1future@gmail.com)
 * @contact     ashl1future@gmail.com
 * @copyright   Alexey Shildyakov
 * 
 * License      MIT - http://datatables.net/license/mit
 *
 * This feature plug-in for DataTables automatically merges columns cells
 * based on it's values equality. It supports multi-column row grouping
 * in according to the requested order with dependency from each previous 
 * requested columns. Now it supports ordering and searching. 
 * Please see the example.html for details.
 * 
 * Rows grouping in DataTables can be enabled by using any one of the following
 * options:
 *
 * * Setting the `rowsGroup` parameter in the DataTables initialisation
 *   to array which containes columns selectors
 *   (https://datatables.net/reference/type/column-selector) used for grouping. i.e.
 *    rowsGroup = [1, 'columnName:name', ]
 * * Setting the `rowsGroup` parameter in the DataTables defaults
 *   (thus causing all tables to have this feature) - i.e.
 *   `$.fn.dataTable.defaults.RowsGroup = [0]`.
 * * Creating a new instance: `new $.fn.dataTable.RowsGroup( table, columnsForGrouping );`
 *   where `table` is a DataTable's API instance and `columnsForGrouping` is the array
 *   described above.
 *
 * For more detailed information please see:
 *     
 */

(function($){

ShowedDataSelectorModifier = {
  order: 'current',
  page: 'current',
  search: 'applied',
}

GroupedColumnsOrderDir = 'asc';


/*
 * columnsForGrouping: array of DTAPI:cell-selector for columns for which rows grouping is applied
 */
var RowsGroup = function ( dt, columnsForGrouping )
{
  this.table = dt.table();
  this.columnsForGrouping = columnsForGrouping;
   // set to True when new reorder is applied by RowsGroup to prevent order() looping
  this.orderOverrideNow = false;
  this.mergeCellsNeeded = false; // merge after init
  this.order = []
  
  var self = this;
  dt.on('order.dt', function ( e, settings) {
    if (!self.orderOverrideNow) {
      self.orderOverrideNow = true;
      self._updateOrderAndDraw()
    } else {
      self.orderOverrideNow = false;
    }
  })
  
  dt.on('preDraw.dt', function ( e, settings) {
    if (self.mergeCellsNeeded) {
      self.mergeCellsNeeded = false;
      self._mergeCells()
    }
  })
  
  dt.on('column-visibility.dt', function ( e, settings) {
    self.mergeCellsNeeded = true;
  })

  dt.on('search.dt', function ( e, settings) {
    // This might to increase the time to redraw while searching on tables
    //   with huge shown columns
    self.mergeCellsNeeded = true;
  })

  dt.on('page.dt', function ( e, settings) {
    self.mergeCellsNeeded = true;
  })

  dt.on('length.dt', function ( e, settings) {
    self.mergeCellsNeeded = true;
  })

  dt.on('xhr.dt', function ( e, settings) {
    self.mergeCellsNeeded = true;
  })

  this._updateOrderAndDraw();
  
/* Events sequence while Add row (also through Editor)
 * addRow() function
 *   draw() function
 *     preDraw() event
 *       mergeCells() - point 1
 *     Appended new row breaks visible elements because the mergeCells() on previous step doesn't apllied to already processing data
 *   order() event
 *     _updateOrderAndDraw()
 *       preDraw() event
 *         mergeCells()
 *       Appended new row now has properly visibility as on current level it has already applied changes from first mergeCells() call (point 1)
 *   draw() event
 */
};


RowsGroup.prototype = {
  setMergeCells: function(){
    this.mergeCellsNeeded = true;
  },

  mergeCells: function()
  {
    this.setMergeCells();
    this.table.draw();
  },

  _getOrderWithGroupColumns: function (order, groupedColumnsOrderDir)
  {
    if (groupedColumnsOrderDir === undefined)
      groupedColumnsOrderDir = GroupedColumnsOrderDir
      
    var self = this;
    var groupedColumnsIndexes = this.columnsForGrouping.map(function(columnSelector){
      return self.table.column(columnSelector).index()
    })
    var groupedColumnsKnownOrder = order.filter(function(columnOrder){
      return groupedColumnsIndexes.indexOf(columnOrder[0]) >= 0
    })
    var nongroupedColumnsOrder = order.filter(function(columnOrder){
      return groupedColumnsIndexes.indexOf(columnOrder[0]) < 0
    })
    var groupedColumnsKnownOrderIndexes = groupedColumnsKnownOrder.map(function(columnOrder){
      return columnOrder[0]
    })
    var groupedColumnsOrder = groupedColumnsIndexes.map(function(iColumn){
      var iInOrderIndexes = groupedColumnsKnownOrderIndexes.indexOf(iColumn)
      if (iInOrderIndexes >= 0)
        return [iColumn, groupedColumnsKnownOrder[iInOrderIndexes][1]]
      else
        return [iColumn, groupedColumnsOrderDir]
    })
    
    groupedColumnsOrder.push.apply(groupedColumnsOrder, nongroupedColumnsOrder)
    return groupedColumnsOrder;
  },
 
  // Workaround: the DT reset ordering to 'asc' from multi-ordering if user order on one column (without shift)
  //   but because we always has multi-ordering due to grouped rows this happens every time
  _getInjectedMonoSelectWorkaround: function(order)
  {
    if (order.length === 1) {
      // got mono order - workaround here
      var orderingColumn = order[0][0]
      var previousOrder = this.order.map(function(val){
        return val[0]
      })
      var iColumn = previousOrder.indexOf(orderingColumn);
      if (iColumn >= 0) {
        // assume change the direction, because we already has that in previos order
        return [[orderingColumn, this._toogleDirection(this.order[iColumn][1])]]
      } // else This is the new ordering column. Proceed as is.
    } // else got milti order - work normal
    return order;
  },
  
  _mergeCells: function()
  {
    var columnsIndexes = this.table.columns(this.columnsForGrouping, ShowedDataSelectorModifier).indexes().toArray()
    var showedRowsCount = this.table.rows(ShowedDataSelectorModifier)[0].length 
    this._mergeColumn(0, showedRowsCount - 1, columnsIndexes)
  },
  
  // the index is relative to the showed data
  //    (selector-modifier = {order: 'current', page: 'current', search: 'applied'}) index
  _mergeColumn: function(iStartRow, iFinishRow, columnsIndexes)
  {
    var columnsIndexesCopy = columnsIndexes.slice()
    currentColumn = columnsIndexesCopy.shift()
    currentColumn = this.table.column(currentColumn, ShowedDataSelectorModifier)
    
    var columnNodes = currentColumn.nodes()
    var columnValues = currentColumn.data()
    
    var newSequenceRow = iStartRow,
      iRow;
    for (iRow = iStartRow + 1; iRow <= iFinishRow; ++iRow) {
      
      if (columnValues[iRow] === columnValues[newSequenceRow]) {
        $(columnNodes[iRow]).hide()
      } else {
        $(columnNodes[newSequenceRow]).show()
        $(columnNodes[newSequenceRow]).attr('rowspan', (iRow-1) - newSequenceRow + 1)
        
        if (columnsIndexesCopy.length > 0)
          this._mergeColumn(newSequenceRow, (iRow-1), columnsIndexesCopy)
        
        newSequenceRow = iRow;
      }
      
    }
    $(columnNodes[newSequenceRow]).show()
    $(columnNodes[newSequenceRow]).attr('rowspan', (iRow-1)- newSequenceRow + 1)
    if (columnsIndexesCopy.length > 0)
      this._mergeColumn(newSequenceRow, (iRow-1), columnsIndexesCopy)
  },
  
  _toogleDirection: function(dir)
  {
    return dir == 'asc'? 'desc': 'asc';
  },
 
  _updateOrderAndDraw: function()
  {
    this.mergeCellsNeeded = true;
    
    var currentOrder = this.table.order();
    currentOrder = this._getInjectedMonoSelectWorkaround(currentOrder);
    this.order = this._getOrderWithGroupColumns(currentOrder)
    this.table.order($.extend(true, Array(), this.order))
    this.table.draw()
  },
};


$.fn.dataTable.RowsGroup = RowsGroup;
$.fn.DataTable.RowsGroup = RowsGroup;

// Automatic initialisation listener
$(document).on( 'init.dt', function ( e, settings ) {
  if ( e.namespace !== 'dt' ) {
    return;
  }

  var api = new $.fn.dataTable.Api( settings );
  
  if ( settings.oInit.rowsGroup ||
     $.fn.dataTable.defaults.rowsGroup )
  {
    options = settings.oInit.rowsGroup?
      settings.oInit.rowsGroup:
      $.fn.dataTable.defaults.rowsGroup;
    var rowsGroup = new RowsGroup( api, options );
    $.fn.dataTable.Api.register( 'rowsgroup.update()', function () {
      rowsGroup.mergeCells();
      return this;
    } );
    $.fn.dataTable.Api.register( 'rowsgroup.updateNextDraw()', function () {
      rowsGroup.setMergeCells();
      return this;
    } );
  }
} );

}(jQuery));

/*

TODO: Provide function which determines the all <tr>s and <td>s with "rowspan" html-attribute is parent (groupped) for the specified <tr> or <td>. To use in selections, editing or hover styles.

TODO: Feature
Use saved order direction for grouped columns
  Split the columns into grouped and ungrouped.
  
  user = grouped+ungrouped
  grouped = grouped
  saved = grouped+ungrouped
  
  For grouped uses following order: user -> saved (because 'saved' include 'grouped' after first initialisation). This should be done with saving order like for 'groupedColumns'
  For ungrouped: uses only 'user' input ordering
*/
</script>
@endsection