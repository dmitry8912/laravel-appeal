<?php


namespace App\Domain\Infrastructure;
use App\Domain\Model\IAppeal;
use App\Models\Appeal as AppealModel;
use Exception;
use Illuminate\Support\Facades\App;

class Appeal implements IAppeal
{

    /**
     * @param string $id
     * @return array
     */
    public static function get(string $id): array
    {
        return AppealModel::find($id)->toArray();
    }

    /**
     * @param string $id
     * @param string $from
     * @param string $email
     * @param string $appeal_text
     */
    public static function create(string $id, string $from, string $email, string $appeal_text): void
    {
        $appeal = new AppealModel();
        $appeal->id = $id;
        $appeal->from = $from;
        $appeal->email = $email;
        $appeal->appeal_text = $appeal_text;
        $appeal->save();
    }

    /**
     * @param string $id
     */
    public static function markRead(string $id): void
    {
        $appeal = AppealModel::find($id);
        $appeal->is_read = true;
        $appeal->save();
    }

    /**
     * @param string $id
     * @throws Exception
     */
    static function markProcessed(string $id): void
    {
        if(!(self::isRead($id) && self::isSetStatusPossible($id)))
        {
            throw new Exception('APPEAL_NOT_READ_OR_ALREADY_PROCESSED');
        }
        $appeal = AppealModel::find($id);
        $appeal->status = 'processed';
        $appeal->save();
    }

    /**
     * @param string $id
     * @param string $reason
     * @throws Exception
     */
    static function markRejected(string $id, string $reason): void
    {
        if(!(self::isRead($id) && self::isSetStatusPossible($id)))
        {
            throw new Exception('APPEAL_NOT_READ_OR_ALREADY_PROCESSED');
        }
        $appeal = AppealModel::find($id);
        $appeal->status = 'rejected';
        $appeal->reject_reason = $reason;
        $appeal->save();
    }

    private static function isRead(string $id): bool
    {
        $appeal = AppealModel::find($id);
        return $appeal->is_read;
    }

    private static function isSetStatusPossible(string $id): bool
    {
        $appeal = AppealModel::find($id);
        return $appeal->status == null;
    }

    /**
     * @return array
     */
    static function getNotRead(): array
    {
        return AppealModel::where('is_read',false)->get()->toArray();
    }

    /**
     * @return array
     */
    static function getNotProcessed(): array
    {
        return AppealModel::where('status',null)->get()->toArray();
    }
}
