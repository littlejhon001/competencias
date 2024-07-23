<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'application/third_party/Autoloader.php';
require_once 'application/third_party/psr/Autoloader.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel{
    private $CI;
    private $spreadsheet;
    private $activeWorksheet;

    public function __construct() {
		$this->CI =& get_instance();
        $this->spreadsheet = new Spreadsheet();
        $this->activeWorksheet = $this->spreadsheet->getActiveSheet();
    }
    public function plantilla_masivo($nombre_archivo=""){
        $this->activeWorksheet->setTitle('Usuarios');
        //cargue de cargos en segunda hoja
        $this->CI->load->model('Cargos_model','cargos');
        $cargos = $this->CI->cargos->listado();
        foreach($cargos as $index => $cargo){
            $celda = ("Z" . ($index+1));
            $this->activeWorksheet->setCellValue( $celda, $cargo->nombre);
        }


        if(!$nombre_archivo){
            $nombre_archivo = 'excel.xlsx';
        }
        //? bordes para la tabla
        $bordes = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        //encabezados tabla usuarios
        $this->activeWorksheet->setCellValue('A1', "Nombre")
        ->setCellValue('B1', "Apellido")
        ->setCellValue('C1', "Email")
        ->setCellValue('D1', "Identificación")
        ->setCellValue('E1', "Rol")
        ->setCellValue('F1', "Cargo")
        ->setCellValue('G1', "Grupo(s)");
        foreach (range('A', 'G') as $columna) {
            $celda = $this->activeWorksheet->getCell("${columna}1");
            $this->activeWorksheet->getColumnDimension($columna)->setAutoSize(true);
            $celda->getStyle()->getFont()->setBold(true);
            $celda->getStyle()->applyFromArray($bordes);
            $this->activeWorksheet->getCell("${columna}2")->getStyle()->applyFromArray($bordes);

        }

        //? VALIDACIÓN DE CORREO

        $cell = 'C2';
        $dataValidation = $this->activeWorksheet->getCell($cell)->getDataValidation();
        $dataValidation->setType(DataValidation::TYPE_CUSTOM)
        ->setFormula1('=ISNUMBER(SEARCH("@", C2))')
        ->setShowDropDown(true)
        ->setShowInputMessage(true)
        ->setPromptTitle('Ingrese un correo válido')
        ->setShowErrorMessage(true)
        ->setErrorStyle(DataValidation::STYLE_STOP)
        ->setErrorTitle('Entrada no válida')
        ->setError('El valor no corresponde a un correo válido.');

        //? VALIDACIÓN DE ROLES
        $this->CI->load->model('Rol_model', 'roles');
        $roles = array_column($this->CI->roles->listado(),'nombre');
        $cell = 'E1';
        $dataValidation = $this->activeWorksheet->getCell($cell)->getDataValidation();
        $dataValidation->setType(DataValidation::TYPE_LIST)
        // Set the formula (the list of allowed values)
        ->setFormula1('"'. implode(",", $roles) .'"')
        // Set other properties
        ->setShowDropDown(true)
        ->setShowInputMessage(true)
        ->setPromptTitle('Seleccione un rol')
        ->setShowErrorMessage(true)
        ->setErrorStyle(DataValidation::STYLE_INFORMATION)
        ->setErrorTitle('Entrada no válida')
        ->setError('El valor no está en la lista seleccionable.');
        // Aplicar la validación de datos a un rango de celdas
        for ($i = 2; $i <= 1000; $i++) {
            $this->activeWorksheet->getCell('E' . $i)->setDataValidation(clone $dataValidation);
        }

        //? Validación grupos (separados por punto y coma)
        $cell = 'G2';
        $dataValidation = $this->activeWorksheet->getCell($cell)->getDataValidation();
        $dataValidation->setType(DataValidation::TYPE_CUSTOM);
        // Set the formula (the list of allowed values)
        $dataValidation->setFormula1('=MOD((VALUE(SUBSTITUTE(G2,";",""))),1)=0');
        // Set other properties
        $dataValidation->setShowInputMessage(true);
        $dataValidation->setPromptTitle('Introduce números separados por comas');
        $dataValidation->setShowErrorMessage(true);
        $dataValidation->setErrorStyle(DataValidation::STYLE_STOP);
        $dataValidation->setErrorTitle('Entrada no válida');
        $dataValidation->setError('Por favor introduce una lista de números separados por punto y coma');

        //? Validación de cargos
        $cell = 'F2';
        $dataValidation = $this->activeWorksheet->getCell($cell)->getDataValidation();
        $dataValidation->setType(DataValidation::TYPE_LIST)
        ->setFormula1('$Z$1:$Z$'. count($cargos));
        // Set the formula (the list of allowed values)
        // Set other properties
        $dataValidation->setShowDropDown(true);
        $dataValidation->setShowInputMessage(true);
        $dataValidation->setPromptTitle('Introduce números separados por comas');
        $dataValidation->setShowErrorMessage(true);
        $dataValidation->setErrorStyle(DataValidation::STYLE_STOP);
        $dataValidation->setErrorTitle('Entrada no válida');
        $dataValidation->setError('Por favor introduce una lista de números separados por comas');

        // Hide column Z
        $this->activeWorksheet->getColumnDimension('Z')->setVisible(false);
        $this->activeWorksheet->getColumnDimension('Z')->setCollapsed(true);

        $this->descarga(new Xlsx($this->spreadsheet), $nombre_archivo);
        return true;
    }
    protected function descarga($writer, $nombre_archivo){
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$nombre_archivo.'"');
        header('Cache-Control: public');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Pragma: public');
        $writer->save('php://output');
    }

    public function obtener_clientes($nombre_archivo){
        try{
            $spreadsheet = IOFactory::load($nombre_archivo);
            // leer la hoja 1 del excel cargado
            $worksheet = $spreadsheet->getSheetByName('Usuarios'); // lectura por indice
            $rows = $worksheet->toArray(null, true, true, true);
            $usuarios = [];
            foreach ($rows as $row => $columns) {
                if ($row >= 2 && $columns['A'] != null) {
                    $usuarios[] = (object) [
                        'nombre' => $columns['A'],
                        'apellido' => $columns['B'],
                        'email' => $columns['C'],
                        'identificacion' => $columns['D'],
                        'Rol_ID' => $columns['E'],
                        'id_cargo' => $columns['F'],
                        'id_grupo' => $columns['G'],
                    ];
                }
            }
            return $usuarios;
        } catch (Exception $e) {
            return null;
        }
    }
}
