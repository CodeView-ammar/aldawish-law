<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Tasawk\Models{
/**
 * Tasawk\Models\CancellationReason
 *
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationReason enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationReason whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationReason whereLocales(string $column, array $locales)
 */
	class CancellationReason extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\Career
 *
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property int $age
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $job_title
 * @property string $position
 * @property array|null $data
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $c_v
 * @property-read mixed $gender_text
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Career enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Career newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Career newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Career query()
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Career whereUpdatedAt($value)
 */
	class Career extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\CaseParty
 *
 * @property int $id
 * @property array $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseParty whereUpdatedAt($value)
 */
	class CaseParty extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\CaseType
 *
 * @property int $id
 * @property array $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseType whereUpdatedAt($value)
 */
	class CaseType extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\ContactType
 *
 * @property int $id
 * @property array $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\Content\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereUpdatedAt($value)
 */
	class ContactType extends \Eloquent {}
}

namespace Tasawk\Models\Content{
/**
 * Tasawk\Models\Content\Banner
 *
 * @property int $id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $title
 * @property array|null $description
 * @property string|null $link
 * @property-read mixed $image_ar
 * @property-read mixed $image_en
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Banner enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 */
	class Banner extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace Tasawk\Models\Content{
/**
 * Tasawk\Models\Content\Contact
 *
 * @property int $id
 * @property string $message
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property int $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $contact_type_id
 * @property-read \Tasawk\Models\ContactType $contactType
 * @property-read \Tasawk\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserId($value)
 */
	class Contact extends \Eloquent {}
}

namespace Tasawk\Models\Content{
/**
 * Tasawk\Models\Content\Page
 *
 * @property bool $status
 * @property int $id
 * @property array $title
 * @property array $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Page enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

namespace Tasawk\Models\Content{
/**
 * Tasawk\Models\Content\Post
 *
 * @property int $id
 * @property array $title
 * @property array $description
 * @property \Illuminate\Support\Carbon $publish_date
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Post enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 */
	class Post extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\Conversation
 *
 * @property int $id
 * @property int $order_id
 * @property string $token
 * @property int $is_started
 * @property string|null $customer_start_at
 * @property string|null $contractor_start_at
 * @property string|null $customer_end_at
 * @property string|null $contractor_end_at
 * @property string|null $finished_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereContractorEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereContractorStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereCustomerEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereCustomerStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereIsStarted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereUpdatedAt($value)
 */
	class Conversation extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property int $active
 * @property string|null $phone_verified_at
 * @property string|null $api_token
 * @property mixed $password
 * @property string|null $remember_token
 * @property array|null $settings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $theme
 * @property string|null $theme_color
 * @property int|null $age
 * @property string|null $gender
 * @property string|null $id_number
 * @property string|null $address
 * @property string|null $nationality_id
 * @property string|null $passport_number
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\DeviceToken> $deviceTokens
 * @property-read int|null $device_tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \ChristianKuri\LaravelFavorite\Models\Favorite> $favorites
 * @property-read int|null $favorites_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Tasawk\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read Customer|null $toCustomer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\VerificationCode> $verificationCodes
 * @property-read int|null $verification_codes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereNationalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePassportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereThemeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 */
	class Customer extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\DeviceToken
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $token
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceToken whereUserId($value)
 */
	class DeviceToken extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\ElectornicReport
 *
 * @property int $id
 * @property string $order_number
 * @property int $customer_id
 * @property string $client_name
 * @property string|null $ristrict
 * @property string $id_number
 * @property string $phone_number
 * @property string $email
 * @property string|null $address
 * @property int|null $case_type
 * @property string|null $case_status
 * @property string|null $court
 * @property int|null $party_in_the_case
 * @property string|null $case_summary
 * @property \Illuminate\Support\Carbon|null $date
 * @property \Tasawk\Enum\OrderStatus $status
 * @property \Tasawk\Enum\OrderPaymentStatus|null $payment_status
 * @property array|null $payment_data
 * @property float|null $total
 * @property array|null $service_data
 * @property mixed|null $quota
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payment_type
 * @property string|null $duration
 * @property string|null $comment
 * @property string|null $case_number
 * @property-read \Tasawk\Models\OrderCancellation|null $cancellation
 * @property-read \Tasawk\Models\CaseParty|null $caseParty
 * @property-read \Tasawk\Models\CaseType|null $caseType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\Order\Condition> $conditions
 * @property-read int|null $conditions_count
 * @property-read \Tasawk\Models\Conversation|null $conversation
 * @property-read \Tasawk\Models\Customer $customer
 * @property-read mixed $attachment
 * @property-read mixed $case_status_name
 * @property-read mixed $date_text
 * @property-read mixed $duration_text
 * @property-read mixed $file
 * @property-read mixed $price_text
 * @property-read mixed $ristrict_name
 * @property-read mixed $status_text
 * @property-read mixed $total_text
 * @property-read mixed $user_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\Order\ItemsLine> $itemsLine
 * @property-read int|null $items_line_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\User $user
 * @property-read \Tasawk\Models\User $userInformation
 * @method static \Illuminate\Database\Eloquent\Builder|Order enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order paid()
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereCaseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereCaseStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereCaseSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereCaseType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereCourt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport wherePartyInTheCase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport wherePaymentData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereQuota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereRistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereServiceData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ElectornicReport whereUpdatedAt($value)
 */
	class ElectornicReport extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\Faq
 *
 * @property int $id
 * @property array $question
 * @property array $answer
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Faq enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 */
	class Faq extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\Nationality
 *
 * @property int $id
 * @property array $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereUpdatedAt($value)
 */
	class Nationality extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\Notification
 *
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $body
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @property-read mixed $title
 * @property-read mixed $url
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> all($columns = ['*'])
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification read()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification unread()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\Order
 *
 * @property int $id
 * @property string $order_number
 * @property int $customer_id
 * @property string $client_name
 * @property string|null $ristrict
 * @property string $id_number
 * @property string $phone_number
 * @property string $email
 * @property string|null $address
 * @property int|null $case_type
 * @property string|null $case_status
 * @property string|null $court
 * @property int|null $party_in_the_case
 * @property string|null $case_summary
 * @property \Illuminate\Support\Carbon|null $date
 * @property \Tasawk\Enum\OrderStatus $status
 * @property \Tasawk\Enum\OrderPaymentStatus|null $payment_status
 * @property array|null $payment_data
 * @property float|null $total
 * @property array|null $service_data
 * @property mixed|null $quota
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payment_type
 * @property string|null $duration
 * @property string|null $comment
 * @property string|null $case_number
 * @property-read \Tasawk\Models\OrderCancellation|null $cancellation
 * @property-read \Tasawk\Models\CaseParty|null $caseParty
 * @property-read \Tasawk\Models\CaseType|null $caseType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\Order\Condition> $conditions
 * @property-read int|null $conditions_count
 * @property-read \Tasawk\Models\Conversation|null $conversation
 * @property-read \Tasawk\Models\Customer $customer
 * @property-read mixed $attachment
 * @property-read mixed $case_status_name
 * @property-read mixed $date_text
 * @property-read mixed $duration_text
 * @property-read mixed $file
 * @property-read mixed $price_text
 * @property-read mixed $ristrict_name
 * @property-read mixed $status_text
 * @property-read mixed $total_text
 * @property-read mixed $user_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\Order\ItemsLine> $itemsLine
 * @property-read int|null $items_line_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\User $user
 * @property-read \Tasawk\Models\User $userInformation
 * @method static \Illuminate\Database\Eloquent\Builder|Order enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order paid()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCaseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCaseStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCaseSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCaseType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCourt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePartyInTheCase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereQuota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereServiceData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\OrderCancellation
 *
 * @property-read \Tasawk\Models\CancellationReason|null $reason
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCancellation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCancellation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCancellation query()
 */
	class OrderCancellation extends \Eloquent {}
}

namespace Tasawk\Models\Order{
/**
 * Tasawk\Models\Order\Condition
 *
 * @property int $id
 * @property int $order_id
 * @property string $name
 * @property string $type
 * @property string $target
 * @property string $value
 * @property int $order
 * @property array $attributes
 * @property array|null $model
 * @method static \Illuminate\Database\Eloquent\Builder|Condition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Condition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Condition query()
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereValue($value)
 */
	class Condition extends \Eloquent {}
}

namespace Tasawk\Models\Order{
/**
 * Tasawk\Models\Order\ItemsLine
 *
 * @property int $id
 * @property int $order_id
 * @property string $name
 * @property float $price
 * @property float $quantity
 * @property array $attributes
 * @property array $conditions
 * @property array $model
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemsLine whereQuantity($value)
 */
	class ItemsLine extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\AboutUs
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs query()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutUs whereUpdatedAt($value)
 */
	class AboutUs extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\CompanyGoal
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read mixed $image_ar
 * @property-read mixed $image_en
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyGoal whereUpdatedAt($value)
 */
	class CompanyGoal extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\CompanyMessage
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read mixed $image_ar
 * @property-read mixed $image_en
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyMessage whereUpdatedAt($value)
 */
	class CompanyMessage extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\OurService
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|OurService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OurService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OurService query()
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurService whereUpdatedAt($value)
 */
	class OurService extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\OurValue
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OurValue whereUpdatedAt($value)
 */
	class OurValue extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\PageContent
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereUpdatedAt($value)
 */
	class PageContent extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\Pages
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\Pages\PageContent> $pageContent
 * @property-read int|null $page_content_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pages query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pages whereUpdatedAt($value)
 */
	class Pages extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\Partner
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUpdatedAt($value)
 */
	class Partner extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\RelevantCompany
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelevantCompany whereUpdatedAt($value)
 */
	class RelevantCompany extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\ScientificExperiences
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificExperiences whereUpdatedAt($value)
 */
	class ScientificExperiences extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\TeamMission
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMission whereUpdatedAt($value)
 */
	class TeamMission extends \Eloquent {}
}

namespace Tasawk\Models\Pages{
/**
 * Tasawk\Models\Pages\TermsCondition
 *
 * @property string $id
 * @property \Tasawk\Enum\PageStatus $page_id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $meta_data
 * @property string|null $section
 * @property string|null $group
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $icon
 * @property string|null $link
 * @property-read mixed $default
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Tasawk\Models\Pages\Pages|null $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition query()
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermsCondition whereUpdatedAt($value)
 */
	class TermsCondition extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property int $active
 * @property string|null $phone_verified_at
 * @property string|null $api_token
 * @property mixed $password
 * @property string|null $remember_token
 * @property array|null $settings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $theme
 * @property string|null $theme_color
 * @property int|null $age
 * @property string|null $gender
 * @property string|null $id_number
 * @property string|null $address
 * @property string|null $nationality_id
 * @property string|null $passport_number
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\DeviceToken> $deviceTokens
 * @property-read int|null $device_tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \ChristianKuri\LaravelFavorite\Models\Favorite> $favorites
 * @property-read int|null $favorites_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Tasawk\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Tasawk\Models\Customer|null $toCustomer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Tasawk\Models\VerificationCode> $verificationCodes
 * @property-read int|null $verification_codes_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNationalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereThemeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \Filament\Models\Contracts\FilamentUser, \Illuminate\Contracts\Translation\HasLocalePreference {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\VerificationCode
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $code
 * @property string|null $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode notExipred()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereUserId($value)
 */
	class VerificationCode extends \Eloquent {}
}

namespace Tasawk\Models{
/**
 * Tasawk\Models\Zone
 *
 * @property int $id
 * @property array $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Zone enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Zone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Zone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Zone query()
 * @method static \Illuminate\Database\Eloquent\Builder|Zone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Zone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Zone whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Zone whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Zone whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Zone whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Zone whereUpdatedAt($value)
 */
	class Zone extends \Eloquent {}
}

