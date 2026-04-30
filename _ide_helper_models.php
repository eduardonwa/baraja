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


namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $platform_id
 * @property string $handle
 * @property string|null $name
 * @property string|null $niche
 * @property int $is_default
 * @property int $is_active
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContentPost> $contentPosts
 * @property-read int|null $content_posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LabPost> $labPosts
 * @property-read int|null $lab_posts_count
 * @property-read \App\Models\Platform $platform
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereHandle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereNiche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account wherePlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAccount {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $metricable_type
 * @property int $metricable_id
 * @property int|null $comments_24h
 * @property int|null $comments_3d
 * @property int|null $comments_7d
 * @property int|null $follows_24h
 * @property int|null $follows_3d
 * @property int|null $follows_7d
 * @property int|null $likes_24h
 * @property int|null $likes_3d
 * @property int|null $likes_7d
 * @property int|null $profile_visits_24h
 * @property int|null $profile_visits_3d
 * @property int|null $profile_visits_7d
 * @property int|null $reposts_24h
 * @property int|null $reposts_3d
 * @property int|null $reposts_7d
 * @property int|null $saves_24h
 * @property int|null $saves_3d
 * @property int|null $saves_7d
 * @property int|null $shares_24h
 * @property int|null $shares_3d
 * @property int|null $shares_7d
 * @property int|null $views_24h
 * @property int|null $views_3d
 * @property int|null $views_7d
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read float $comments_engagement_rate
 * @property-read float $likes_engagement_rate
 * @property-read float $profile_visit_to_follow_conversion_rate
 * @property-read float $reposts_engagement_rate
 * @property-read float $saves_engagement_rate
 * @property-read float $shares_engagement_rate
 * @property-read float $total_engagement_rate
 * @property-read float $view_to_profile_conversion_rate
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $metricable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereComments24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereComments3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereComments7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereFollows24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereFollows3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereFollows7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereLikes24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereLikes3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereLikes7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereMetricableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereMetricableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereProfileVisits24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereProfileVisits3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereProfileVisits7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereReposts24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereReposts3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereReposts7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereSaves24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereSaves3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereSaves7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereShares24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereShares3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereShares7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereViews24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereViews3d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric whereViews7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric withConversionData()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentMetric withEngagementData()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperContentMetric {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $rotation_cycle_item_id
 * @property int|null $account_id
 * @property string|null $title
 * @property string|null $type
 * @property string|null $format
 * @property string|null $caption
 * @property string|null $published_at
 * @property string|null $hashtags
 * @property string|null $people_tagged_and_dmd
 * @property string|null $external_post_id
 * @property string|null $notes
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\Account|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Hypothesis> $hypotheses
 * @property-read int|null $hypotheses_count
 * @property-read \App\Models\ContentMetric|null $metric
 * @property-read \App\Models\RotationCycleItem $rotationCycleItem
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereExternalPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereHashtags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost wherePeopleTaggedAndDmd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereRotationCycleItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContentPost whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperContentPost {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RotationCycleItem> $cycleItems
 * @property-read int|null $cycle_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HookGroup> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Idea> $ideas
 * @property-read int|null $ideas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hook query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hook whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hook whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hook whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperHook {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Hook> $hooks
 * @property-read int|null $hooks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HookGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HookGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HookGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HookGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HookGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HookGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HookGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HookGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperHookGroup {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $source_content_post_id
 * @property string|null $title
 * @property string|null $insight
 * @property string $variable
 * @property string|null $variable_custom
 * @property string $status
 * @property int $positive_signals_count
 * @property int $failed_tests_count
 * @property int|null $confidence_score
 * @property string|null $notes
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property \Carbon\CarbonImmutable|null $deleted_at
 * @property-read string $variable_label
 * @property-read \App\Models\ContentPost $sourceContentPost
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HypothesisTest> $tests
 * @property-read int|null $tests_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereConfidenceScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereFailedTestsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereInsight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis wherePositiveSignalsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereSourceContentPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereVariable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis whereVariableCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hypothesis withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperHypothesis {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $hypothesis_id
 * @property string $change_description
 * @property string $result
 * @property int|null $signal_strength
 * @property string|null $observations
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\Hypothesis|null $hypothesis
 * @property-read \App\Models\LabPost|null $labPost
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest whereChangeDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest whereHypothesisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest whereObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest whereSignalStrength($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HypothesisTest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperHypothesisTest {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $hook_id
 * @property string $title
 * @property string|null $description
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RotationCycleItem> $cycleItems
 * @property-read int|null $cycle_items_count
 * @property-read string $cycle_names
 * @property-read \App\Models\Hook $hook
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereHookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperIdea {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $hypothesis_test_id
 * @property int|null $account_id
 * @property string $variable_variant
 * @property string|null $notes
 * @property string|null $caption
 * @property bool $same_format
 * @property string|null $format_used
 * @property \Carbon\CarbonImmutable|null $published_at
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\HypothesisTest $hypothesisTest
 * @property-read \App\Models\ContentMetric|null $metric
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereFormatUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereHypothesisTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereSameFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LabPost whereVariableVariant($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLabPost {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account> $accounts
 * @property-read int|null $accounts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Platform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Platform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Platform query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Platform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Platform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Platform whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Platform whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Platform whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPlatform {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property bool $is_active
 * @property string $generation_mode
 * @property int $size
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RotationCycleItem> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle whereGenerationMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRotationCycle {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $rotation_cycle_id
 * @property int $hook_id
 * @property int|null $idea_id
 * @property int $position
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\ContentPost|null $contentPost
 * @property-read \App\Models\RotationCycle $cycle
 * @property-read string $display_name
 * @property-read \App\Models\Hook $hook
 * @property-read \App\Models\Idea|null $idea
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem whereHookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem whereIdeaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem whereRotationCycleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RotationCycleItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRotationCycleItem {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Carbon\CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property \Carbon\CarbonImmutable|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

