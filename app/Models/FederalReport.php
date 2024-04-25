<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FederalReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'federal_report';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
