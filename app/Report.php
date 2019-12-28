<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idReport
 * @property string $report_date
 * @property string $report_subject
 * @property string $report_comment
 * @property int $Users_idUser
 * @property int $Announces_idAnnounce
 * @property Announce $announce
 * @property User $user
 */
class Report extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idReport';

    /**
     * @var array
     */
    protected $fillable = ['report_date', 'report_subject','Report_Categories_idReportCategorie','Users_Reported','report_comment', 'Users_idUser', 'Announces_idAnnounce'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function announce()
    {
        return $this->belongsTo('App\Announce', 'Announces_idAnnounce', 'idAnnounce');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
