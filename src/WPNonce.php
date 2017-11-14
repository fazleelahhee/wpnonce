<?php
namespace Fazleelahhee\Inpsyde;

class WPNonce
{
    /**
     * Retrieve or display nonce hidden field for forms.
     **/
    public function getField($action = -1, $name = "_wpnonce", $referer = true , $echo = true) {
        $name = esc_attr( $name );
        $nonce_field = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="' . self::create( $action ) . '" />';

        if ( $referer )
            $nonce_field .= wp_referer_field( false );

        if ( $echo )
            echo $nonce_field;

        return $nonce_field;
    }

    /**
     * Retrieve URL with nonce added to URL query.
     **/

    public function getUrl($actionurl, $action = -1, $name = '_wpnonce' ) {
        $actionurl = str_replace( '&amp;', '&', $actionurl );
        return esc_html( add_query_arg( $name, self::create( $action ), $actionurl ) );
    }

    /**
     * Verify that correct nonce was used with time limit.
     **/
    public function verify($nonce, $action = -1) {
        $nonce = (string) $nonce;
        $user = wp_get_current_user();
        $uid = (int) $user->ID;
        if ( ! $uid ) {
            /**
             * Filters whether the user who generated the nonce is logged out.
             *
             * @since 3.5.0
             *
             * @param int    $uid    ID of the nonce-owning user.
             * @param string $action The nonce action.
             */
            $uid = apply_filters( 'nonce_user_logged_out', $uid, $action );
        }

        if ( empty( $nonce ) ) {
            return false;
        }

        $token = wp_get_session_token();
        $i = self::tick();

        // Nonce generated 0-12 hours ago
        $expected = substr( wp_hash( $i . '|' . $action . '|' . $uid . '|' . $token, 'nonce'), -12, 10 );
        if ( hash_equals( $expected, $nonce ) ) {
            return 1;
        }

        // Nonce generated 12-24 hours ago
        $expected = substr( wp_hash( ( $i - 1 ) . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), -12, 10 );
        if ( hash_equals( $expected, $nonce ) ) {
            return 2;
        }

        /**
         * Fires when nonce verification fails.
         *
         * @since 4.4.0
         *
         * @param string     $nonce  The invalid nonce.
         * @param string|int $action The nonce action.
         * @param WP_User    $user   The current user object.
         * @param string     $token  The user's session token.
         */
        do_action( 'wp_verify_nonce_failed', $nonce, $action, $user, $token );

        // Invalid nonce
        return false;
    }

    /**
     * Get the time-dependent variable for nonce creation.
     * */

    protected function tick() {
        $nonce_life = apply_filters( 'nonce_life', DAY_IN_SECONDS );
        return ceil(time() / ( $nonce_life / 2 ));
    }

    /**
     * Creates a cryptographic token tied to a specific action, user, user session,
     * and window of time. **/

    protected function create($action = -1) {
        $user = wp_get_current_user();
        $uid = (int) $user->ID;
        if ( ! $uid ) {
            /** This filter is documented in wp-includes/pluggable.php */
            $uid = apply_filters( 'nonce_user_logged_out', $uid, $action );
        }
        $token = wp_get_session_token();
        $i = self::tick();
        return substr( wp_hash( $i . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), -12, 10 );
    }
}