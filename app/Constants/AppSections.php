<?php

namespace App\Constants;

class AppSections
{
    // --- HEADER ---
    const MAIN_SLIDER = 'main_slider';
    const SPONSOR_BANNER = 'sponsor_banner';

    // --- NAVIGATION TILES (Gulfood Style) ---
    const EXHIBITORS = 'exhibitors';
    const PRODUCTS = 'exhibitor_products';
    const B2B_MEETING = 'b2b_meeting';
    const MESSAGERIE_INBOX = 'messagerie_inbox';
    const AWARDS = 'hce_cleaning_awards';
    const SPONSORS_PARTNERS = 'sponsors_partners';
    const SPEAKERS = 'speakers';
    const CONFERENCES = 'conferences';
    const BADGE = 'badge';
    const PLAN_TRIP = 'plan_your_trip';
    const FLOOR_PLAN = 'floor_plan';

    // --- LOGO LISTS ---
    const INSTITUTIONAL_PARTNERS = 'institutional_partners';
    const MEDIA_PARTNERS = 'media_partners';
    const EXHIBITIONS_PARTNERS = 'exhibitions_partners';
    const TRADEMARKS = 'trademarks';

    /**
     * Returns a human-readable list for the Admin Panel Dropdown
     */
    public static function getOptions(): array
    {
        return [
            self::MAIN_SLIDER => '📸 Main Header Slider',
            self::SPONSOR_BANNER => '📢 Sponsor Banner (Wide)',

            // Tiles
            self::EXHIBITORS => '🏢 Exhibitors Tile',
            self::PRODUCTS => '🛍️ Exhibitor Products Tile',
            self::B2B_MEETING => '🤝 B2B Meeting Tile',
            self::MESSAGERIE_INBOX => '✉️ Messagerie / Inbox Tile',
            self::AWARDS => '🏆 HCE Awards Tile',
            self::SPEAKERS => '🎤 Speakers Tile',
            self::CONFERENCES => '📅 Conferences / Agenda Tile',
            self::BADGE => '🆔 My Badge Tile',
            self::PLAN_TRIP => '✈️ Plan Your Trip Tile',
            self::FLOOR_PLAN => '🗺️ Floor Plan Tile',

            // Lists
            self::SPONSORS_PARTNERS => '⭐ Sponsors & Partners List',
            self::INSTITUTIONAL_PARTNERS => '🏛️ Institutional Partners',
            self::MEDIA_PARTNERS => '📰 Media Partners',
            self::EXHIBITIONS_PARTNERS => '🌍 Exhibition Partners',
            self::TRADEMARKS => '®️ Trademarks',
        ];
    }
}
