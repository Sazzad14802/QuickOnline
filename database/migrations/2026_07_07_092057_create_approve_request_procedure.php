<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(
            "CREATE OR REPLACE PROCEDURE approve_request( p_request_id IN NUMBER) AS
                v_user_id NUMBER;;
                v_subscription_id NUMBER;;
                v_new_package_id NUMBER;;
                v_request_type VARCHAR(20);
            BEGIN
                SELECT user_id,subscription_id, new_package_id, request_type
                INTO v_user_id, v_subscription_id, v_new_package_id, v_request_type
                FROM requests WHERE request_id = p_request_id ;

                IF v_request_type = 'new' THEN
                    INSERT INTO subscriptions(user_id, package_id, status) VALUES(v_user_id, v_new_package_id, 'active');

                ELSIF v_request_type = 'change' THEN
                    UPDATE subscriptions SET package_id = v_new_package_id WHERE subscription_id = v_subscription_id;

                ELSIF v_request_type = 'unsubscribe' THEN
                    DELETE FROM subscriptions WHERE subscription_id = v_subscription_id;

                END IF;

                DELETE FROM requests WHERE request_id = p_request_id;

                COMMIT;

            EXCEPTION
                WHEN OTHERS THEN
                    ROLLBACK;
                    RAISE;
                    
            END approve_request;
            /"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approve_request_procedure');
    }
};
