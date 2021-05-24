<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class NT_Postman_Tile
{
    private static $_instance = null;
    public static function instance(){
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct(){
        add_filter( 'dt_details_additional_tiles', [ $this, "dt_details_additional_tiles" ], 10, 2 );
        add_filter( "dt_custom_fields_settings", [ $this, "dt_custom_fields" ], 1, 2 );
        add_action( "dt_details_additional_section", [ $this, "dt_add_section" ], 30, 2 );
    }

    /**
     * This function registers a new tile to a specific post type
     *
     * @todo Set the post-type to the target post-type (i.e. contacts, groups, trainings, etc.)
     * @todo Change the tile key and tile label
     *
     * @param $tiles
     * @param string $post_type
     * @return mixed
     */
    public function dt_details_additional_tiles( $tiles, $post_type = "" ) {
        if ( $post_type === "contacts" ){
            $tiles["nt_postman"] = [ "label" => __( "NT Postman", 'disciple_tools' ) ];
        }
        return $tiles;
    }

    /**
     * @param array $fields
     * @param string $post_type
     * @return array
     */
    public function dt_custom_fields( array $fields, string $post_type = "" ) {
        /**
         * @todo set the post type
         */
        if ( $post_type === "contacts" ){
            /**
             * @todo Add the fields that you want to include in your tile.
             *
             * Examples for creating the $fields array
             * Contacts
             * @link https://github.com/DiscipleTools/disciple-tools-theme/blob/256c9d8510998e77694a824accb75522c9b6ed06/dt-contacts/base-setup.php#L108
             *
             * Groups
             * @link https://github.com/DiscipleTools/disciple-tools-theme/blob/256c9d8510998e77694a824accb75522c9b6ed06/dt-groups/base-setup.php#L83
             */

            /**
             * This is an example of a key select field
             */
            $fields["nt_postman_keyselect"] = [
                'name' => "NT Postage Status",
                'type' => 'key_select',
                "tile" => "nt_postman",
                'default' => [
                    'needs_nt'   => [
                        "label" => _x( 'Needs NT Posted', 'Postage Status label', 'disciple_tools' ),
                        "description" => _x( "This contact needs an NT to be posted", "Postage Status field description", 'disciple_tools' ),
                        'color' => "#F43636"
                    ],
                    'nt_sent'     => [
                        "label" => _x( "NT Posted", 'Postage Status label', 'disciple_tools' ),
                        "description" => _x( "The NT for this contact has been posted", "Postage Status field description", 'disciple_tools' ),
                        'color' => "#FF9800"
                    ],
                    'nt_received'     => [
                        "label" => _x( "NT Received", 'Postage Status label', 'disciple_tools' ),
                        "description" => _x( "The contact has received the NT", "Postage Status field description", 'disciple_tools' ),
                        'color' => "#4CAF50"
                    ],
                ],
                'icon' => get_template_directory_uri() . '/dt-assets/images/edit.svg',
                "default_color" => "#366184",
                "select_cannot_be_empty" => true
            ];
        }
        return $fields;
    }

    public function dt_add_section( $section, $post_type ) {
        /**
         * @todo set the post type and the section key that you created in the dt_details_additional_tiles() function
         */
        if ( $post_type === "contacts" && $section === "nt_postman" ){
            /**
             * These are two sets of key data:
             * $this_post is the details for this specific post
             * $post_type_fields is the list of the default fields for the post type
             *
             * You can pull any query data into this section and display it.
             */
            $this_post = DT_Posts::get_post( $post_type, get_the_ID() );
            $post_type_fields = DT_Posts::get_post_field_settings( $post_type );
            ?>
        <?php }
    }
}
NT_Postman_Tile::instance();
