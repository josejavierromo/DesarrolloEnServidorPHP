<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Eventos".
 *
 * @property integer $Codigo_evento
 * @property string $Nombre_evento
 * @property string $Email_evento
 * @property string $Direccion_evento
 * @property integer $Telefono_evento
 * @property string $Descripcion_evento
 * @property resource $Logo
 * @property resource $Portada
 * @property string $Fecha_creacion
 * @property string $Fecha_inicio
 * @property string $Fecha_fin
 * @property integer $Numero_usuarios
 * @property integer $Cod_usuario
 *
 * @property Actividades[] $actividades
 * @property Alertas[] $alertas
 * @property DispositivosEventos[] $dispositivosEventos
 * @property Dispositivos[] $idDispositivos
 * @property Enlaces[] $enlaces
 * @property Usuarios $codUsuario
 * @property Imagenes[] $imagenes
 * @property Ponentes[] $ponentes
 * @property Videos[] $videos
 * @property Votaciones[] $votaciones
 */
class Eventos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Eventos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre_evento', 'Descripcion_evento', 'Logo', 'Portada', 'Cod_usuario'], 'required'],
            [['Telefono_evento', 'Numero_usuarios', 'Cod_usuario'], 'integer'],
            [['Logo', 'Portada'], 'string'],
            [['Fecha_creacion', 'Fecha_inicio', 'Fecha_fin'], 'safe'],
            [['Nombre_evento', 'Email_evento'], 'string', 'max' => 63],
            [['Direccion_evento'], 'string', 'max' => 127],
            [['Descripcion_evento'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_evento' => 'Codigo Evento',
            'Nombre_evento' => 'Nombre Evento',
            'Email_evento' => 'Email Evento',
            'Direccion_evento' => 'Direccion Evento',
            'Telefono_evento' => 'Telefono Evento',
            'Descripcion_evento' => 'Descripcion Evento',
            'Logo' => 'Logo',
            'Portada' => 'Portada',
            'Fecha_creacion' => 'Fecha Creacion',
            'Fecha_inicio' => 'Fecha Inicio',
            'Fecha_fin' => 'Fecha Fin',
            'Numero_usuarios' => 'Numero Usuarios',
            'Cod_usuario' => 'Cod Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividades()
    {
        return $this->hasMany(Actividades::className(), ['Cod_evento' => 'Codigo_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlertas()
    {
        return $this->hasMany(Alertas::className(), ['Cod_evento' => 'Codigo_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivosEventos()
    {
        return $this->hasMany(DispositivosEventos::className(), ['Cod_evento' => 'Codigo_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDispositivos()
    {
        return $this->hasMany(Dispositivos::className(), ['Id_dispositivo' => 'Id_dispositivo'])->viaTable('Dispositivos_Eventos', ['Cod_evento' => 'Codigo_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnlaces()
    {
        return $this->hasMany(Enlaces::className(), ['Cod_evento' => 'Codigo_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['Codigo_usuario' => 'Cod_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagenes()
    {
        return $this->hasMany(Imagenes::className(), ['Cod_evento' => 'Codigo_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPonentes()
    {
        return $this->hasMany(Ponentes::className(), ['Cod_evento' => 'Codigo_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Videos::className(), ['Cod_evento' => 'Codigo_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotaciones()
    {
        return $this->hasMany(Votaciones::className(), ['Cod_evento' => 'Codigo_evento']);
    }
}
