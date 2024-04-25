<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use PHPExcel_IOFactory;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'fileFederal' => 'required|mimes:xls,xlsx|max:2048',
        ]);

        $file = $request->file('fileFederal');

        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, ['xls', 'xlsx'])) {
            return response()->json(['error' => 'O arquivo deve estar em formato Excel.'], 400);
        }

        // Criar o objeto PHPExcel_IOFactory
        $objReader = PHPExcel_IOFactory::createReaderForFile($file->getPathname());
        // Carregar o arquivo
        $spreadsheet = $objReader->load($file->getPathname());
        // Obter a planilha ativa
        $worksheet = $spreadsheet->getActiveSheet();
        // Obter os dados da planilha em formato de matriz
        $rows = $worksheet->toArray();

        foreach ($rows as $row) {
            Upload::create([
                'remessa' => $row[0],
                'declaracao' => $row[1],
                'dataHoraDeclaracao' => $row[2],
                'numeroLote' => $row[3],
                'master' => $row[4],
                'niDestinatario' => $row[6],
                'tipoDocumento' => $row[7],
                'destinatario' => $row[8],
                'enderecoDestinatario' => $row[9],
                'complementoDestinatario' => $row[10],
                'municipioDestinatario' => $row[11],
                'estadoDestinatario' => $row[12],
                'cepDestinatario' => $row[13],
                'descricaoRemessa' => $row[14],
                'destCom' => $row[15],
                'situacao' => $row[16],
                'volsTotal' => $row[17],
                'volsReceb' => $row[18],
                'pesoBrutoKg' => $row[19],
                'valorRemessaUS' => $row[20],
                'valorFreteUS' => $row[21],
                'freteModoPagamento' => $row[22],
                'valorTributavelUS' => $row[23],
                'valorTributavelRS' => $row[24],
                'valorIIRS' => $row[25],
                'valorMultasRS' => $row[26],
                'multaMoraRS' => $row[27],
                'jurosOficioRS' => $row[28],
                'jurosMoraRS' => $row[29],
                'remetente' => $row[30],
                'enderecoRemetente' => $row[31],
                'complementoRemetente' => $row[32],
                'paisRemetente' => $row[33],
                'orgaoSelecao' => $row[34],
                'manifesto' => $row[35],
                'dhManifesto' => $row[36],
                'documentoAnexo' => $row[37],
                'dataUltimaAnexacao' => $row[38],
            ]);
        }

        return response()->json(['message' => 'Upload realizado com sucesso e salvos no banco de dados.']);
    }
}
