<?php

namespace Richard\HyperfPassport;

use Hyperf\DbConnection\Model\Model;

class AuthCode extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_auth_codes';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'revoked' => 'bool',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Get the client that owns the authentication code.
     *
     * @return \Hyperf\Database\Model\Relations\BelongsTo
     */
    public function client() {
        $passport = make(\Richard\HyperfPassport\Passport::class);
        return $this->belongsTo($passport->clientModel());
    }

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName() {
        return config('passport.storage.database.connection') ?? $this->connection;
    }

}
