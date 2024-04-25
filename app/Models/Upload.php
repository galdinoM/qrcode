<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'fileFederal',
        'remessa',
        'declaracao',
        'dataHoraDeclaracao',
        'numeroLote',
        'master',
        'niDestinatario',
        'tipoDocumento',
        'destinatario',
        'enderecoDestinatario',
        'complementoDestinatario',
        'municipioDestinatario',
        'estadoDestinatario',
        'cepDestinatario',
        'descricaoRemessa',
        'destCom',
        'situacao',
        'volsTotal',
        'volsReceb',
        'pesoBrutoKg',
        'valorRemessaUS',
        'valorFreteUS',
        'freteModoPagamento',
        'valorTributavelUS',
        'valorTributavelRS',
        'valorIIRS',
        'valorMultasRS',
        'multaMoraRS',
        'jurosOficioRS',
        'jurosMoraRS',
        'remetente',
        'enderecoRemetente',
        'complementoRemetente',
        'paisRemetente',
        'orgaoSelecao',
        'manifesto',
        'dhManifesto',
        'documentoAnexo',
        'dataUltimaAnexacao',
    ];
}
