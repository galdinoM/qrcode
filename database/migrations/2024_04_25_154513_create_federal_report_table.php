<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('federal_report', function (Blueprint $table) {
            $table->id();
            $table->string('remessa');
            $table->string('declaracao');
            $table->string('dataHoraDeclaracao');
            $table->string('numeroLote');
            $table->string('master');
            $table->string('niDestinatario');
            $table->string('tipoDocumento');
            $table->string('destinatario');
            $table->string('enderecoDestinatario');
            $table->string('complementoDestinatario');
            $table->string('municipioDestinatario');
            $table->string('estadoDestinatario');
            $table->string('cepDestinatario');
            $table->string('descricaoRemessa');
            $table->string('destCom');
            $table->string('situacao');
            $table->string('volsTotal');
            $table->string('volsReceb');
            $table->string('pesoBrutoKg');
            $table->string('valorRemessaUS');
            $table->string('valorFreteUS');
            $table->string('freteModoPagamento');
            $table->string('valorTributavelUS');
            $table->string('valorTributavelRS');
            $table->string('valorIIRS');
            $table->string('valorMultasRS');
            $table->string('multaMoraRS');
            $table->string('jurosOficioRS');
            $table->string('jurosMoraRS');
            $table->string('remetente');
            $table->string('enderecoRemetente');
            $table->string('complementoRemetente');
            $table->string('paisRemetente');
            $table->string('orgaoSelecao');
            $table->string('manifesto');
            $table->string('dhManifesto');
            $table->string('documentoAnexo');
            $table->string('dataUltimaAnexacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('federal_report');
    }
};
